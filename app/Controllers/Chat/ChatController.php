<?php

namespace Matcha\Controllers\Chat;
use Matcha\Controllers\Controller;
use Respect\Validation\Validator as v;
use Matcha\Models\Chat;

/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 10/11/18
 * Time: 6:53 PM
 */

class ChatController extends Controller
{
    public function index($request, $response)
    {
        // добавить сюда массив сообщений с переписки и в глобальное окружение на вывод


        $route = $request->getAttribute('route');
        $chat_id = $route->getArgument('chat_id');
        // print_r($courseId); die();
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
        $this->container->view->getEnvironment()->addGlobal('message_id', $message_id);
        $this->container->view->getEnvironment()->addGlobal('arrMessage', $arrMes);

        return $this->view->render($response, 'chat/chat.twig');
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

        // CHAT ID
//        $chat_id = $request->getParam('chat_id');;
        $chat_id = 1;
        Chat::addMessage($message, $chat_id);


        
        /*
		** send csrf values for ajax request
		*/
        $ajax_csrf = $request->getAttribute('ajax_csrf');
        return $response->write(json_encode($ajax_csrf));

    }
}
