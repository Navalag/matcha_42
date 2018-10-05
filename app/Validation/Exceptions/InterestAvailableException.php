<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 3:10 PM
 */

namespace Matcha\Validation\Exceptions;


use Respect\Validation\Exceptions\ValidationException;

class InterestAvailableException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Interest is already taken',
        ],
    ];
}