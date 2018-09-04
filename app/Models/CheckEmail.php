<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/3/18
 * Time: 3:10 PM
 */

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;  // передало в Model все методы

class CheckEmail extends Model
{
    protected $table = "checkEmail";

    protected $fillable = [
        'email',
        'uniqid',
    ];
}