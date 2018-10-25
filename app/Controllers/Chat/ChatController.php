<?php

namespace Matcha\Controllers\Chat;
use Matcha\Controllers\Controller;
use Respect\Validation\Validator as v;
use Matcha\Models\Chat;
use Matcha\Models\MatchedPeople;
use Matcha\Models\User;

class ChatController extends Controller
{
	public function index($request, $response)
	{
		$route = $request->getAttribute('route');
		$chat_id = $route->getArgument('chat_id');

		$matchedPair = MatchedPeople::getUsersByChatId($chat_id);
		if ($matchedPair && ($matchedPair->first_id == $_SESSION['user'] || $matchedPair->second_id == $_SESSION['user']))
		{
			$msgAll = Chat::getAllMessagesByChatId($chat_id);
			$activeUser = User::getAllUserInfo();
			$destUser = User::getUserInfoById(
						$matchedPair->first_id == $_SESSION['user']
						? $matchedPair->second_id
						: $matchedPair->first_id
					);

			$msgAttr['active_user_id'] = $activeUser->id;
			$msgAttr['active_username'] = $activeUser->username;
			$msgAttr['dest_user_id'] = $destUser->id;
			$msgAttr['dest_username'] = $destUser->username;
			$msgAttr['chat_id'] = $chat_id;
			$this->container->view->getEnvironment()->addGlobal('msg_attr', $msgAttr);
			$this->container->view->getEnvironment()->addGlobal('msg_array', $msgAll);

			return $this->view->render($response, 'chat/chat.twig');
		}
		return $response->withRedirect($this->router->pathFor('home'));
	}

	public function addMessage($request, $response)
	{
		$chatId = $request->getParam('chat_id');
		$activeUser = $request->getParam('active_user_id');
		$destUser = $request->getParam('dest_user_id');
		$message = $request->getParam('chat_message');

		$result = Chat::addMessage($message, $chatId, $activeUser, $destUser);
		/*
		** send csrf values for ajax request
		*/
		$ajax_csrf = $request->getAttribute('ajax_csrf');

		return $response->write(json_encode($ajax_csrf));
	}
}
