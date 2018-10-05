<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 9/5/18
 * Time: 11:55 AM
 */

namespace Matcha\Models;


use Illuminate\Database\Eloquent\Model;

class InterestList extends Model
{
    // $db = require_once __DIR__ . '/../../conf/settings.php';

    protected $table = 'interest_list';
    /* найти способ передать имя таблицы с контейнера */
    /* protected $table = $db['db']['dbtable']['users']; */



    /* ???
     * по какому шыблону мы создаем польщователя
     * */
    protected $fillable = [
        'interest',
    ];

    public static function  showAllInterests()
    {
        $listInterests = InterestList::all();
        $allInterests = array();

        foreach($listInterests as $row) {
            $allInterests[] = $row->interest;
        }

        return $allInterests;
    }
}
