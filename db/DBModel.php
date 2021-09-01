<?php

namespace app\core\db;


use app\core\Application;
use app\core\Model;

abstract class DBModel extends Model
{

    abstract public static function tableName():string;

    abstract public function attributes():array;

    abstract  public static function primaryKey():string;


    public function save(){ //save in the table
        $tableName = $this->tableName();
        $attributes = $this->attributes();  //can also take from the table schema
        $prepareparams = array_map(fn($attr) => ":$attr", $attributes);  //attributes make :attributes
        $stmt  = self::prepare("INSERT INTO $tableName (".implode(',',$attributes).") VALUES(".implode(',',$prepareparams).")");

        foreach ($attributes as $attribute) {
            $stmt->bindValue(":$attribute", $this->{$attribute}); //iterate through attributes
        }
        $stmt->execute();
        return true;
    }

    public static function  prepare($sql){ // hmm... why static
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes)); // $email = :email AND $password = :password
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}