<?php


namespace App\core;


abstract class Model
{
    protected static $tableName = null;

    public static function findById($id)
    {
        $tableName = self::getTableName();
        $sql = "select * from " . $tableName . " where id = " . $id;
        $connection = DB::getConnection();
        $res = $connection->query($sql);
        if ($res->num_rows) {
            return $res->fetch_object(static::class);
        }

    }

    public static function getAll($limit = null, $offset = null)
    {
        $limitStr = null;
        if ($limit || $offset) {
            $limitStr = ' LIMIT ' . ($offset ?? 0) . ',' . ($limit ?? 100);
        }
        $tableName = self::getTableName();
        $sql = "select * from " . $tableName . $limitStr ;
        $connection = DB::getConnection();
        $res = $connection->query($sql);
        $arr = [];
        if ($res->num_rows) {

            while ($obj = $res->fetch_object(static::class)) {
                $arr[] = $obj;
            }
        }
        return $arr;
    }

    public function save()
    {
        if (isset($this->id) && !empty($this->id)) {
            // update

        } else {
            // insert
            // static::create([]);
        }

        echo 'not implemented';

    }


    public static function create($arr = [])
    {
        $keys = array_keys($arr);
        $keys = '`' . implode('`,`', $keys) . '`';

        $values = array_values($arr);
        $values = "'" . implode("','", $values) . "'";

        $tableName = self::getTableName();
        $connection = DB::getConnection();
        $sql = 'INSERT into ' . $tableName . "($keys) VALUES ($values)";
        $connection->query($sql);

        return static::findById($connection->insert_id);

    }

    public static function getTableName()
    {
        if (static::$tableName) {
            return static::$tableName;
        }

        $tableName = explode('\\', static::class);
        $tableName = end($tableName);
        $tableName = mb_strtolower($tableName) . 's';
        return $tableName;
    }
}