<?php


namespace App\core;


abstract class Model
{
    protected static $fillable = [];
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

    public static function selectWithConditions(array $arr)
    {
        $tableName = self::getTableName();
        $sql = "SELECT * FROM " . $tableName;
        if (isset($arr['where']) && !empty($arr['where'])) {
            $sql .= ' Where ';
            $split = false;
            foreach ($arr['where'] as $condition) {
                if (count($condition) == 2) {
                    $split = true;
                    $sql .= "`{$condition[0]}` = '{$condition[1]}' AND ";
                } elseif (count($condition) == 3) {
                    $split = true;
                    $sql .= "`{$condition[0]}` {$condition[1]} '{$condition[2]}' AND ";
                }
            }
            if ($split) {
                $sql = substr($sql, 0, -5);
            }
        }


        if (isset($arr['order']) && !empty($arr['order'])) {
            if (count($arr['order']) == 2) {
                $sql .= ' ORDER by ' . $arr['order']['field'] . ' ' . $arr['order']['way'];
            } elseif (count($arr['order']) == 1) {
                $sql .= ' ORDER by ' . $arr['order']['field'];
            }
        }
        // TODO сделать проверки
        if (isset($arr['limit']) && !empty($arr['limit'])) {
            if (count($arr['limit']) == 2) {
                $sql .= ' LIMIT ' . $arr['limit']['offset'] . ', ' . $arr['limit']['limit'];
            } elseif (count($arr['limit']) == 1) {
                $sql .= ' LIMIT ' . $arr['limit']['limit'];
            }
        }

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

    public static function getAll($limit = null, $offset = null)
    {
        $limitStr = null;
        if ($limit || $offset) {
            $limitStr = ' LIMIT ' . ($offset ?? 0) . ',' . ($limit ?? 100);
        }
        $tableName = self::getTableName();
        $sql = "select * from " . $tableName . $limitStr;
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
        $table = static::getTableName();
        if (isset($this->id) && !empty($this->id)) {
            $sql = "UPDATE " . $table . " SET ";
            foreach (static::$fillable as $column) {
                $sql .= "`$column` = '" . $this->{$column} . "' ,";

            }
            $sql = substr($sql, 0, -1);
            $sql .= "WHERE id = " . $this->id;
            $connection = DB::getConnection();
            $connection->query($sql);

            return static::findById($this->id);

        } else {
            $values = [];
            foreach (static::$fillable as $column) {
                $values[$column] = $this->{$column};
            }

            return static::create($values);
        }


    }


    public static function create($arr = [])
    {
        foreach ($arr as $key => $value) {
            if (!in_array($key, static::$fillable, true)) {
                unset($arr[$key]);
            }
        }

        $keys = array_keys($arr);
        $keys = '`' . implode('`,`', $keys) . '`';

        $values = array_values($arr);
        $values = "'" . implode("','", $values) . "'";

        $tableName = self::getTableName();
        $connection = DB::getConnection();
        $sql = 'INSERT into ' . $tableName . "($keys) VALUES ($values)";
        $res = $connection->query($sql);

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

    public function load(array $arr)
    {

        foreach ($arr as $key => $item) {
            if (in_array($key, static::$fillable, true)) {
                $this->{$key} = $arr[$key];
            }
        }
    }

    public static function delete($id)
    {
        $tableName = self::getTableName();
        $connection = DB::getConnection();
        $sql = "DELETE FROM " . $tableName . " WHERE id = " . $id;
        return $connection->query($sql);

    }
}