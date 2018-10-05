<?php

namespace Matcha\Models;

/*
 * User наследуется от Model
 * Model содержит все методы по работе с БД
 * User может использовать все методы что есть в Illuminate\Database;   
 */

use Illuminate\Database\Eloquent\Model;  // передало в Model все методы

class User extends Model
{
    // $db = require_once __DIR__ . '/../../conf/settings.php';

    protected $table = 'user';
    /* найти способ передать имя таблицы с контейнера */
    /* protected $table = $db['db']['dbtable']['users']; */



    /* ???
     * по какому шыблону мы создаем польщователя
     * */
    protected $fillable = [
        'email',
        'username',
        'name',
        'surname',
        'password',
        'rating',
    ];

    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
    public function setEmail($id, $email)
    {
        User::where('id', $id)->update([
            'email' => $email
        ]);
    }

    public static function setActiveAccount($email)
    {
        User::where('email', $email)->update([
            'active' => "1",
        ]);
    }

    public static function setUsername($id, $username)
    {
        User::where('id', $id)->update([
            'username' => $username,
        ]);
    }

    public static function setName($id, $name)
    {
        User::where('id', $id)->update([
            'name' => $name,
        ]);
    }

    public static function setSurname($id, $surname)
    {
        User::where('id', $id)->update([
            'surname' => $surname,
        ]);
    }
}