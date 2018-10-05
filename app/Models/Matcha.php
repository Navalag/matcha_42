<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 12:00 PM
 */

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;
//namespace Matcha\Models\Chat;

class Matcha extends Model
{
    protected $table = 'matcha';

    protected $fillable = [
        'first_id',
        'second_id',
        'chat_id',
    ];

    public static function setMatcha($first_id, $second_id)
    {
        $chat_id = time();

        Matcha::create([
            'first_id' => $first_id,
            'second_id' => $second_id,
            'chat_id' => $chat_id,
        ]);

    }

    public static function unsetMatcha($first_id, $second_id)
    {
        $allMatcha = Matcha::all();

        foreach ($allMatcha as $row)
        {
            if ($row->first_id == $first_id && $row->second_id == $second_id ||
                $row->first_id == $second_id && $row->second_id == $first_id) {
                Matcha::where('id', $row->id)->delete();
//                Chat::del
                return ;
            }
        }
    }
}