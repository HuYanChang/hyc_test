<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3
 * Time: 15:38
 */

namespace app\models;

use hxphp\base\Model;
use hxphp\db\Db;

/**
 * 用户Model
 */

class IndexModel extends Model{
    protected $table = 'item';

    public function search($keyword)
    {
        $sql = "select * from `$this->table` where `item_name` like :keyword";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':keyword' => "%$keyword%"]);
        $sth->execute();

        return $sth->fetchAll();
    }
}