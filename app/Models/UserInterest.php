<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 11:57 AM
 */

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    protected $table = 'user_interest';

    protected $fillable = [
        'user_id',
        'interest_id',
    ];
}