<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 12:00 PM
 */

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notification';

    protected $fillable = [
        'id',
        'user_id',
        'from_user_id',
        'type',
        'see',
    ];

    public static function addNew($user_id, $type)
    {
        $type = 0;

        if ($type == 1)
            $type = 1;

        Notifications::create([
            'user_id' => $user_id,
            'from_user_id' => $_SESSION['user'],
            'type' => $type,
            'see' => 0,
        ]);

        $count = Notifications::where([
            'user_id' => $user_id,
            'see' => 0,
        ])->all();
        var_dump($count);
//        $this->container->view->getEnvironment()->addGlobal('notification_count', $count);
    }
}