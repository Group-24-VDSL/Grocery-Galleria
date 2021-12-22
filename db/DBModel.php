<?php

namespace app\core\db;


use app\core\Application;
use app\core\Model;
use app\models\Item;

abstract class DBModel extends Model
{

    abstract public static function tableName():string;

    abstract public function attributes():array;

    abstract  public static function primaryKey():array;


    public function save(){ //save in the table
        $tableName = $this->tableName();
        $attributes = $this->attributes();  //can also take from the table schema // User model attributes with values
        $prepareparams = array_map(fn($attr) => ":$attr", $attributes);  //attributes make :attributes
        $stmt  = self::prepare("INSERT INTO $tableName (".implode(',',$attributes).") VALUES(".implode(',',$prepareparams).")");
        foreach ($attributes as $attribute) {
            $stmt->bindValue(":$attribute", $this->{$attribute}); //iterate through attributes
            // bind the User model attribute values with each :attribute into the sql statement
        }
        $stmt->execute();
        return true;
    }


    public function update(){
        $keys = $this->primaryKey();
        $tableName = $this->tableName();
        $where = array();
        foreach ($keys as $key) {
            $where[$key] = $this->{$key};
        }
        $dbObj = self::findOne($where);
        $dbObjarr = array_slice((array)$dbObj, 0, -1); // db object to array
        $objarr = array_slice((array)$this, 0, -1); // this object to array
        $result = array_diff_assoc($objarr,$dbObjarr);
        if(!empty($result)){
            $stmt  = self::prepare("UPDATE $tableName SET ".implode(", ",array_map(fn($attr) => "$attr=:$attr", array_keys($result)))." WHERE ".implode(" AND ", array_map(fn($attr) => "$attr=:$attr", array_keys($where))));
            foreach ($result as $key => $value) {
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

    public static function delete($where=[])
    {
        $tableName = static::tableName();
        $stmt  = self::prepare("DELETE FROM $tableName WHERE ".implode(" AND ", array_map(fn($attr) => "$attr=:$attr", array_keys($where))));
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value); //iterate through attributes
            // bind the User model attribute values with each :attribute into the sql statement
        }
        $stmt->execute();
        return true;
    }

    public static function prepare($sql){ // hmm... why static
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where=[])
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

    public static function findAll($where =[],$limit = null)
    {
        $tableName = static::tableName();
        if(is_null($limit)){
            if(empty($where)){
                $statement = self::prepare("SELECT * FROM $tableName");
                $statement->execute();
                return $statement->fetchAll(\PDO::FETCH_CLASS,static::class);
            }
            $attributes = array_keys($where);
            $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes)); // $email = :email AND $password = :password
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }else{
            if(empty($where)){
                $statement = self::prepare("SELECT * FROM $tableName LIMIT $limit");
                $statement->execute();
                return $statement->fetchAll(\PDO::FETCH_CLASS,static::class);
            }
            $attributes = array_keys($where);
            $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes)); // $email = :email AND $password = :password
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql LIMIT $limit");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS,static::class);
    }

    public static function getLastID(){
        $tableName = static::tableName();
        $primary = static::primaryKey();
        $statement = self::prepare("SELECT MAX($primary[0]) FROM $tableName");
        $statement->execute();
        return (int)$statement->fetchColumn();
    }

    public function getLastInsertID()
    {
        $statement = self::prepare("SELECT MAX($primary[0]) FROM $tableName");
        $statement->execute();
        return (int)$statement->fetchColumn();
    }

//    public function singleProcedure($procedure,$id,$value)
//    {
//        $stmt = self::prepare("CALL $procedure(:id,:value)");
//        $stmt->bindValue(':id',$id);
//        $stmt->bindValue(':value',$value);
//        $stmt->execute();
//        return true;
//    }
    public static function callProcedure($procedure,$values=[])
    {
        if(empty($values)){
            $stmt = self::prepare("CALL $procedure()");
            $stmt->execute();
        }else{
            $keys = array_keys($values);
            $sqlKeys = implode(",", array_map(fn($key) => ":$key", $keys));
            $stmt = self::prepare("CALL $procedure($sqlKeys)");
            foreach ($values as $key => $value) {
                $stmt->bindValue(":$key",$value);
            }
            $stmt->execute();

        }
        return true;

    }

    //for your dirty queries
    public static function query($string,$fetch_type,$fetchAll=null)
    {
        $statement = self::prepare($string);
        $statement->execute();
        if($fetchAll){
            return $statement->fetchAll($fetch_type);
        }
        return $statement->fetch($fetch_type);
    }


}