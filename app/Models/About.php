<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/4/18
 * Time: 3:55 PM
 */

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;  // передало в Model все методы

class About extends Model
{
    protected $table = 'about';

    protected $fillable = [
        'user_id',
        'gender',
        'about_me',
        'age',
        'sexual_pref',
        // 'biography',
    ];
}
