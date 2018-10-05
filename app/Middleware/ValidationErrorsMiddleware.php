<?php

namespace Matcha\Middleware;

/* в основном классе Middleware в конструктор добавлен весь
 * функционал что был в контейнере (все объявленные класы)
 * теперь методы класса ValidationErrorsMiddleware вызываеются атоматически
 * со всеми данными програмы и определять куда будут перенаправленны
 * запросы по групам $app->group();
 */
class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        /*
         * запишет переменные ошибок в json черз addGobal
         * очистит SESSION 
         * в twig это можно вывести через переменную errors
         *
         * если class Auth передал поля с ошибками в class Validator
         * то поля с ошибками будут переданы в $_SESSION['errors'];
         * после в json строку которая будет выведена на странице 
         * */
        if (isset($_SESSION['errors']))
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);

        
        unset($_SESSION['errors']);

        $response = $next($request, $response);
        return $response;
    }
}