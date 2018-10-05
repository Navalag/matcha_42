<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 11:59 AM
 */

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id',
        'liked_id',
    ];
}