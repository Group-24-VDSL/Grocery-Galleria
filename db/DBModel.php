<?php

namespace app\core\db;


use app\core\Application;
use app\core\Model;

abstract class DBModel extends Model
{

    public static function delete($where = [])
    {
        $tableName = static::tableName();
        $stmt = self::prepare("DELETE FROM $tableName WHERE " . implode(" AND ", array_map(fn($attr) => "$attr=:$attr", array_keys($where))));
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value); //iterate through attributes
            // bind the User model attribute values with each :attribute into the sql statement
        }
        $stmt->execute();
        return true;
    }

    public static function findAll($where = [], $limit = null)
    {
        $tableName = static::tableName();
        if (is_null($limit)) {
            if (empty($where)) {
                $statement = self::prepare("SELECT * FROM $tableName");
                $statement->execute();
                return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
            }
            $attributes = array_keys($where);
            $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes)); // $email = :email AND $password = :password
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        } else {
            if (empty($where)) {
                $statement = self::prepare("SELECT * FROM $tableName LIMIT $limit");
                $statement->execute();
                return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
            }
            $attributes = array_keys($where);
            $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes)); // $email = :email AND $password = :password
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql LIMIT $limit");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function getLastID()
    {
        $tableName = static::tableName();
        $primary = static::primaryKey();
        $statement = self::prepare("SELECT MAX($primary[0]) FROM $tableName");
        $statement->execute();
        return (int)$statement->fetchColumn();
    }

    abstract public static function primaryKey(): array;

//    public function update($attributes = [],$where=[])
//    {
//        $tableName = $this->tableName();
//        $stmt  = self::prepare("UPDATE $tableName SET ".implode(", ",array_map(fn($attr) => "$attr=:$attr", array_keys($attributes)))." WHERE ".implode(" AND ", array_map(fn($attr) => "$attr=:$attr", array_keys($where))));
//        foreach ($attributes as $key => $value) {
//            $stmt->bindValue(":$key", $value); //iterate through attributes
//            // bind the User model attribute values with each :attribute into the sql statement
//        }
//        foreach ($where as $key => $value) {
//            $stmt->bindValue(":$key", $value); //iterate through attributes
//            // bind the User model attribute values with each :attribute into the sql statement
//        }
//        $stmt->execute();
//        return true;
//    }

    public function save()
    { //save in the table
        $tableName = $this->tableName();
        $attributes = $this->attributes();  //can also take from the table schema // User model attributes with values
        $prepareparams = array_map(fn($attr) => ":$attr", $attributes);  //attributes make :attributes
        $stmt = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $prepareparams) . ")");
        foreach ($attributes as $attribute) {
            $stmt->bindValue(":$attribute", $this->{$attribute}); //iterate through attributes
            // bind the User model attribute values with each :attribute into the sql statement
        }
        $stmt->execute();
        return true;
    }

    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    public static function prepare($sql)
    { // hmm... why static
        return Application::$app->db->pdo->prepare($sql);
    }

    public function update()
    {
        $keys = $this->primaryKey();
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $newValues = array();
        $where = array();
        foreach ($keys as $key) {
            $where[$key] = $this->{$key};
        }
        $dbObj = self::findOne($where);
        if ($dbObj != $this) {
            foreach ($attributes as $attribute) {
                if (isset($this->$attribute) && ($dbObj->$attribute != $this->$attribute)) {
                    $newValues[$attribute] = $this->$attribute;
                }
            }
            $stmt = self::prepare("UPDATE $tableName SET " . implode(", ", array_map(fn($attr) => "$attr=:$attr", array_keys($newValues))) . " WHERE " . implode(" AND ", array_map(fn($attr) => "$attr=:$attr", array_keys($where))));
            foreach ($newValues as $key => $value) {
                $stmt->bindValue(":$key", $value); //iterate through attributes
                // bind the User model attribute values with each :attribute into the sql statement
            }
            foreach ($where as $key => $value) {
                $stmt->bindValue(":$key", $value); //iterate through attributes
                // bind the User model attribute values with each :attribute into the sql statement
            }
            $stmt->execute();
        }
        return true;
    }

    public static function findOne($where = [])
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes)); // $email = :email AND $password = :password
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

}