<?php

namespace Matcha\Controllers;

class Controller
{
    /* если объявить переменную protected $view которая совпадет с переменной
     * что лежит в библионтеке визуализации то произойдет конфликт
     * так как переменная и функция что качаються магичесих функций должны быть публичны
     * */

    /*
     * передать все методы что есть в конструктуре классу Контроллер и его наследникам
     * */
    public function __construct($container)
    {
        $this->container = $container;
    }


    /* чтобы не писать длинную строку запросв к методу часть ее можна опустить
     * и дулать запрос только с того места что треуетьб
     * гетер подставит весь путь сам
     * */
    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}