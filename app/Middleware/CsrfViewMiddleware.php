<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 8/21/18
 * Time: 10:13 AM
 */

namespace Matcha\Middleware;

/* в основном классе Middleware в конструктор добавлен весь
 * функционал что был в контейнере (все объявленные класы)
 * теперь методы класса CsrfViewMiddleware вызываеются атоматически
 * со всеми данными програмы и определять куда будут перенаправленны
 * запросы по групам $app->group();
 * 
 * Данный класс предназначен для защиты пользователя от злоумышлиннека
 * он будет отправлять на страницу пользователя невидимый input
 * с содержащим в себе кодом tokena
 */
class CsrfViewMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        /*
         * через addGlobal добавляем в csrf значение field что будет служить
         * хранением tokena с его именим и значением для отправки через post
         * и проверки пользователя
         *
         * Возможно этого поля хватит в конечном итоге чтобы проверить
         * тот ли пользователь зашел и сделал запрос
         * */
         $this->container->view->getEnvironment()->addGlobal('csrf', [
             'field' => '
                <input type="hidden" name="'. $this->container->csrf->getTokenNameKey() . '" 
                    value="'. $this->container->csrf->getTokenName() .'">
                <input type="hidden" name="'. $this->container->csrf->getTokenValueKey() .'" 
                    value="'. $this->container->csrf->getTokenValue() .'">
             ',
         ]);

        $response = $next($request, $response);
        return $response;
    }
}