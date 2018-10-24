<?php

namespace Matcha\Controllers\Chat;
use Matcha\Controllers\Controller;
use Respect\Validation\Validator as v;
use Matcha\Models\Chat;
use Matcha\Models\MatchedPeople;

class ChatController extends Controller
{
    public function index($request, $response)
    {
        // добавить сюда массив сообщений с переписки и в глобальное окружение на вывод
        $route = $request->getAttribute('route');
        $chat_id = $_SERVER['REQUEST_URI'];

        $chat_id = substr($chat_id, 6, 16);
        // print_r($courseId); die();
        $chatRow = MatchedPeople::where('chat_id', $chat_id)->first();
        if ($chatRow && ($chatRow->first_id == $_SESSION['user'] || $chatRow->second_id == $_SESSION['user']))
        {
            $arrMes = [];
            $allMessage = Chat::all();
            foreach ($allMessage as $rowMessage)
            {
                // $chat_id = $request->getParam('chat_id');

                if ($rowMessage->chat_id == $chat_id)
                {
                    $arrMes[] = $rowMessage;
                }
            }
            $userInfo = $this->checker->user();

            $message_id['username'] = $userInfo->username;
            $message_id['chat_id'] = $chat_id;
            $this->container->view->getEnvironment()->addGlobal('message_id', $message_id);
            $this->container->view->getEnvironment()->addGlobal('arrMessage', $arrMes);

            return $this->view->render($response, 'chat/chat.twig');
        }
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function addMessage($request, $response)
    {
//        $validation = $this->validator->validate($request, [
//            'chat-user' => v::notEmpty(),
//            'chat-message' => v::notEmpty()(),
//        ]);
//        if ($validation->failed()) {
//            return $response->withRedirect($this->router->pathFor('auth.password.change'));
//        }

        $id = $request->getParam('chat_user');
        $message = $request->getParam('chat_message');
        $chat_id = $request->getParam('chat_id');

        // CHAT ID
//        $chat_id = $request->getParam('chat_id');;
        $result = Chat::addMessage($message, $chat_id);
        // var_dump($result);die;
        // var_dump($result);


        
        /*
		** send csrf values for ajax request
		*/
        $ajax_csrf = $request->getAttribute('ajax_csrf');
        return $response->write(json_encode($ajax_csrf));

    }
}
