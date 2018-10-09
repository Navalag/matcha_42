<?php

namespace Matcha\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'email_confirmed',
        'fake_account',
        'active',
        'about_me',
        'gender',
        'age',
        'fame_rating',
        'facebook_link',
        'instagram_link',
        'twittwer_link',
        'google_plus_link',
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
            'email_confirmed' => "1",
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
            'first_name' => $name,
        ]);
    }

    public static function setSurname($id, $surname)
    {
        User::where('id', $id)->update([
            'last_name' => $surname,
        ]);
    }
}