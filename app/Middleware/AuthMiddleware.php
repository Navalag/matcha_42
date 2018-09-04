<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 8/21/18
 * Time: 1:57 PM
 */

namespace Matcha\Middleware;

/* в основном классе Middleware в конструктор добавлен весь
 * функционал что был в контейнере (все объявленные класы)
 * теперь методы класса AuthMiddleware вызываеются атоматически
 * со всеми данными програмы и определять куда будут перенаправленны
 * запросы по групам $app->group();
 *
 * чтобы объяснить пользователю его ошибку 
 * можно через flash тправить ему сообщение о 
 * совершенными им неправильными дейтвиями
 */
class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (!$this->container->checker->check()) {
            $this->container->flash->addMessage('error', 'Please sign in before doing that.');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }

        $response = $next($request, $response);
        return $response;
    }
}