<?php

declare(strict_types=1);

include_once("review.class.php");

class Menu
{
    public int $id;

    public function getMenuDishes(): array
    {
        $array = array();

        //database

        return $array;
    }
}

class Dish
{
    public int $id;
    public string $name;
    public string $price;
    public string $category;

    public function __construct(int $id, string $name, string $price, string $category)
    {
        $this->id = $id;
        $this->username = $name;
        $this->address = $price;
        $this->phone = $category;
    }
}

class Restaurant
{
    public int $id;
    public string $username;
    public string $address;
    public string $phone;
    public string $email;

    public function __construct(int $id, string $username, string $address, string $phone, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    public static function getRestaurant(PDO $db, int $id): ?Restaurant
    {

        //database 
        return null;
    }

    public function getMenu(): Menu
    {
        //database
        return new Menu();
    }

    public function getRestaurantReviews(): ?Review
    {



        return null;
    }
}
