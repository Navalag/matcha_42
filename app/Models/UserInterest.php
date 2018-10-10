<?php

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