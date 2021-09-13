<?php

namespace app\models;

class Shop extends \app\core\UserModel
{
    //ShopID 	Name 	Address 	Email 	ContactNo 	Location 	City 	Suburb 	ShopName 	ShopDesc 	ShopBanner
    public int $ShopID;
    public string $Name;
    public string $Address;
    public string $Email;
    public string $ContactNo;
    public string $Location;
    public string $City;
    public string $Suburb;

    public static function tableName(): string
    {
        return 'shop';
    }

    public function attributes(): array
    {
        return ['ShopID','Name','Address','Email','ContactNo','Location','City','Suburb','ShopName','ShopDesc','ShopBanner'];
    }

    public static function primaryKey(): string
    {
        return 'ShopID';
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }

    public function getDisplayName(): string
    {
        return $this->Name;
    }
}