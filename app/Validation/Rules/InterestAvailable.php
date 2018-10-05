<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 3:04 PM
 */

namespace Matcha\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Matcha\Models\InterestList;

class InterestAvailable extends AbstractRule
{
    public function validate($input)
    {
        return InterestList::where('interest', $input)->count() === 0;
    }
}