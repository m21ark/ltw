<?php

declare(strict_types=1);


require_once("review.class.php");

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
    public string $price;
    public string $category;

    public function __construct(int $id, string $name, string $price, string $category)
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
                (int)$dish['DishID'],
                $dish['Name'],
                $dish['Price'],
                $dish['Category']
            );
        } else return null;
    }

    public static function getRandomDishes(PDO $db, int $limit) :array {

        $dishes = [];
        $stmt = $db->prepare('
            SELECT *
            FROM Dish
            ORDER BY RANDOM()
            LIMIT ?
        ');

        $stmt->execute(array($limit));

        $arr = $stmt->fetchAll();

        foreach($arr as $dish) {
            array_push($dishes, new Dish(
                (int)$dish['DishID'],
                $dish['Name'],
                $dish['Price'],
                $dish['Category']
            ));
        }

        return $dishes;
    }
}

class Restaurant
{
    public int $id;
    public string $name;
    public string $address;
    //public string $phone;
    public string $category;

    public function __construct(int $id, string $name, string $address, string $category)
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
                (int)$restaurant['RestaurantID'],
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
                $restaurant['Category']
            ));
        }

        return $restaurants;
    }
}
