<?php
use Matcha\Middleware\AuthMiddleware;
use Matcha\Middleware\GuestMiddleware;

$app->group('', function () {
	/*
	** sign up routes
	*/
	$this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$this->post('/auth/signup', 'AuthController:postSignUp');
	/*
	** sign in routes
	*/
	$this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
	$this->post('/auth/signin', 'AuthController:postSignIn');
	/*
	** reset password routes
	*/
	$this->get('/auth/password/forgot', 'AuthController:getResetPassword')->setName('auth.password.forgot');
	$this->post('/auth/password/forgot', 'AuthController:postResetPassword');
	/*
	** activate account routes
	*/
	$this->post('/activate', 'ActivateController:activate');
})->add(new GuestMiddleware($container));

$app->group('', function () {
	/*
	** user home page
	*/
	$this->get('/', 'HomeController:index')->setName('home');
	/*
	** sign out
	*/
	$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	/*
	** edit profile
	*/
	$this->get('/user/edit', 'EditController:getChangeProfile')->setName('user.edit');
	$this->post('/user/edit', 'EditController:postChangeProfile')->setName('user.edit');
	/*
	** edit profile (handle user photo)
	*/
	$this->post('/user/edit/photo_delete', 'PhotoController:postDeletePhoto')->setName('user.edit.photo_delete');
	$this->post('/user/edit/photo_upload', 'PhotoController:postUploadPhoto')->setName('user.edit.photo_post');
	/*
	** edit profile (handle interests)
	*/
	$this->post('/user/edit/interests_delete', 'InterestsController:postDeleteInterestsProfile')->setName('user.edit.interests_delete');
	$this->post('/user/edit/interests_add', 'InterestsController:postAddInterestsProfile')->setName('user.edit.interests_add');
	/*
	** edit profile (set geolocation)
	*/
	$this->post('/user/edit/set_geolocation', 'EditController:postSetGeolocation');
	/*
	** account settings (change email and password)
	*/
	$this->get('/user/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
	$this->post('/user/password/change', 'PasswordController:postChangePassword');
	/*
	** account settings (reset password)
	*/
	$this->post('/user/password/reset', 'PasswordController:postResetPassword');
	/*
	** discovery settings
	*/
	$this->get('/user/search/discovery_settings', 'DiscoverySettingsController:getEditDiscoverySettings')->setName('user.search.discovery_settings');
	$this->post('/user/search/discovery_settings', 'DiscoverySettingsController:postEditDiscoverySettings');
	/*
	** discovery settings (manage interests)
	*/
	$this->post('/user/search/discovery_settings_add_interest', 'DiscoverySettingsController:postAddDiscoveryInterests');
	$this->post('/user/search/discovery_settings_remove_interest', 'DiscoverySettingsController:postDeleteDiscoveryInterests');
	/*
	** find a match
	*/
	$this->get('/search/all', 'SearchController:getAllProfile')->setName('search.all');
	/*
	** find a match (manage actions)
	*/
	$this->post('/search/like', 'SearchActionsController:getLike')->setName('search.like');
	$this->post('/search/nope', 'SearchActionsController:getNope')->setName('search.nope');
	$this->post('/search/block', 'SearchActionsController:getBlockUser')->setName('search.block');
	$this->post('/search/report_fake', 'SearchActionsController:getRepotFakeAccount')->setName('search.report_fake');
	$this->post('/search/check_profile', 'SearchActionsController:getCheckProfile')->setName('search.check_profile');
	/*
	** my matches
	*/
	$this->get('/my-matches', 'MyMatchesController:getMyMatches')->setName('my-matches');
	$this->get('/my-matches/unmatch/{user_id}', 'MyMatchesController:getUnmatch')->setName('my-matches.unmatch.{user_id}');
	/*
	** my activity log
	*/
	$this->get('/activity-log', 'MyLogController:getActivityLog')->setName('activity-log');
	/*
	** other user profile
	*/
	$this->get('/user-page/{user_id}', 'MyMatchesController:getOtherUserProfile')->setName('user-page.{user_id}');
	/*
	** chat
	*/
	$this->get('/chat/{chat_id}', 'ChatController:index')->setName('chat');
    $this->post('/chat/addMessage', 'ChatController:addMessage')->setName('chat.addMessage');
    /*
	** notifications (messages)
	*/
	$this->post('/notifications/new-message', 'NotificationsController:addMessageNotification');
	$this->post('/notifications/load-messages', 'NotificationsController:loadMessageNotifications');
	$this->post('/notifications/open-message', 'NotificationsController:openMessageNotification');
	/*
	** notifications (all other notif)
	*/
	$this->post('/notifications/new-notification', 'NotificationsController:addOtherNotification');
	$this->get('/notifications/open-activity-log', 'NotificationsController:openLikeCheckProfNotification');
	$this->get('/notifications/open-my-matches', 'NotificationsController:openMatchUnmatchNotification');

})->add(new AuthMiddleware($container));
