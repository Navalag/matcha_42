<?php

namespace Matcha\Middleware;

/* в основном классе Middleware в конструктор добавлен весь
 * функционал что был в контейнере (все объявленные класы)
 * теперь методы класса OldInputMiddleware вызываеются атоматически
 * со всеми данными програмы и определять куда будут перенаправленны
 * запросы по групам $app->group();
 */
class OldInputMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        /* чтобы при первом запросе не было записи данных c пост
         * так как они на этот момент не старые а актуальные
         * мы сначала запищем что было до этого 
         * потом запишем что есть в пост запросе
         * далее будет уже выдано данные с прошлого запроса
         * */
        $this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);
        return $response;
    }
}