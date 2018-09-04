<?php

namespace Matcha\Validation;

/*
 * use Validation Library
 * importing a single class into your context:
 * */

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

/*
 * служит для учета ошибок и их записи в $_SESSION['errors']
 *
 * и ответа есть ли еще ошибки
 */
class Validator
{
    protected $errors;

    public function editTextError()
    {
        $pattern = array();
        $replacement = array();

        $pattern[0] = '/Password_old/';
        $pattern[1] = '/Password_new/';
        $pattern[2] = '/Password_repeat/';
        $replacement[0] = 'Password';
        $replacement[1] = 'Password';
        $replacement[2] = 'Password';

        if ($this->errors) {
            foreach ($this->errors as $key => $value) {
                    $this->errors[$key] = preg_replace($pattern, $replacement, $value);
            }
        }
    }

    public function validate($request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            /*
             * цикл для проверки всех строк формы
             * отслеживание ошибок и наполнение ими массив по которому будет проверка на какую страницу перейти
             * usfirst преобразует первый сисвол строки в веръний регистр
             * 
             * после проверки статическими методами в авторизации
             * данные отправляються в своем ожидаемом виде либо false
             * что выдаст ошибку 
             * */
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $this->editTextError();

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

}