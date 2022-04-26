<?php

declare(strict_types=1);

include_once("review.class.php");

class Menu
{
    public int $id;
    public array $resDishes;

    public function __construct(int $id, array $resDishes)
    {
        $this->id = $id;
        $this->resDishes = $resDishes;
    }

    public function getMenuDishes(PDO $db): array
    {
        $array = array();

        foreach ($this->resDishes as $pair) {
            array_push($array, Dish::getDish($db, $pair["DishID"]));
        }

        return $array;
    }
}

class Dish
{
    public int $id;
    public string $name;
    public int $price;
    public int $category;

    public function __construct(int $id, string $name, int $price, int $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public static function getDish(PDO $db, int $id) : ?Dish {
        $stmt = $db->prepare('
            SELECT *
            FROM Dish
            WHERE DishID = ?
        ');

        $stmt->execute(array($id));

        if ($dish = $stmt->fetch()) {
            return new Dish(
                $dish['DishID'],
                $dish['Name'],
                $dish['Price'],
                $dish['Category']
            );
        } else return null;
    }
}

class Restaurant
{
    public int $id;
    public string $name;
    public string $address;
    //public string $phone;
    public int $category;

    public function __construct(int $id, string $name, string $address, int $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        //$this->phone = $phone;
        $this->category = $category;
    }

    public static function getRestaurant(PDO $db, int $id): ?Restaurant
    {

        $stmt = $db->prepare('
            SELECT *
            FROM Restaurant
            WHERE RestaurantID = ?
        ');

        $stmt->execute(array($id));

        if ($restaurant = $stmt->fetch()) {
            return new Restaurant(
                $restaurant['RestaurantID'],
                $restaurant['Name'],
                $restaurant['Address'],
                $restaurant['Category']
            );
        } else return null;
    }

    public function getMenu(PDO $db): Menu
    {
        $stmt = $db->prepare('
            SELECT *
            FROM Menu
            WHERE RestaurantID = ?
        ');

        $stmt->execute(array($this->id));

        return new Menu($this->id, $stmt->fetchAll());
    }

    public function getRestaurantReviews(PDO $db): ?array
    {

        $stmt = $db->prepare('
            SELECT *
            FROM Review
            WHERE RestaurantID = ?
        ');

        $stmt->execute(array($this->id));

        $reviews = $stmt->fetchAll();
        $array = [];
        
        foreach($reviews as $review) {
            array_push($array, new Review(
                $review['ReviewID'],
                $review['Score'],
                $review['ReviewComment'],
                $review['DateOfReview'],
            ));
        }

        return $array;
    }

    public static function getRandomRestaurants(PDO $db, int $limit) :array {

        $restaurants = [];
        $stmt = $db->prepare('
            SELECT *
            FROM Restaurant
            ORDER BY RANDOM()
            LIMIT ?
        ');

        $stmt->execute(array($limit));

        $arr = $stmt->fetchAll();

        foreach($arr as $restaurant) {
            array_push($restaurants, new Restaurant(
                (int)$restaurant['RestaurantID'], // does the array returned from the querie is always a string ?
                $restaurant['Name'],
                $restaurant['Address'],
                (int)$restaurant['Category']
            ));
        }

        return $restaurants;
    }
}
