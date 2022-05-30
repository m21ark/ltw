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
            array_push($array, Dish::getDish($db, (int)$pair["DishID"]));
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
    public string $description;

    public function __construct(int $id, string $name, string $price, string $category, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->description = $description;
    }

    public static function getDish(PDO $db, int $id): ?Dish
    {
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
                $dish['Category'],
                $dish['Description']
            );
        } else return null;
    }

    public function getRestaurantID(PDO $db): int
    {

        $stmt = $db->prepare('
        SELECT restaurantID
        FROM Menu
        WHERE DishID = ?');

        $stmt->execute(array($this->id));

        if ($id = $stmt->fetch()) {
            return (int)$id['RestaurantID'];
        } else return 0;
    }

    public function getIngredients(PDO $db): array
    {
        $stmt = $db->prepare('select IngredientName
         from Ingredient natural join DishIngredients
         where DishID = ?');

        $stmt->execute(array($this->id));
        $ings = $stmt->fetchAll();
        return $ings;
    }

    public static function getRandomDishes(PDO $db, int $limit): array
    {

        $dishes = [];
        $stmt = $db->prepare('
            SELECT *
            FROM Dish
            ORDER BY RANDOM()
            LIMIT ?
        ');

        $stmt->execute(array($limit));

        $arr = $stmt->fetchAll();

        foreach ($arr as $dish) {
            array_push($dishes, new Dish(
                (int)$dish['DishID'],
                $dish['Name'],
                $dish['Price'],
                $dish['Category'],
                $dish['Description']
            ));
        }

        return $dishes;
    }

    public static function getDishesBySearch(PDO $db, string $query, int $offset = null): array
    {

        $dishes = [];
        $stmt = $db->prepare('
            SELECT *
            FROM Dish
            WHERE Name LIKE "%" || ? || "%"
            LIMIT ?, 4
        ');

        $stmt->execute(array($query, $offset * 4));

        $arr = $stmt->fetchAll();

        foreach ($arr as $dish) {
            array_push($dishes, new Dish(
                (int)$dish['DishID'],
                $dish['Name'],
                $dish['Price'],
                $dish['Category'],
                $dish['Description']
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
    public string $phone;
    public string $category;
    public string $description;

    public function __construct(int $id, string $name, string $address, string $phone, string $category, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->category = $category;
        $this->description = $description;
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
                $restaurant['phone'],
                $restaurant['Category'],
                $restaurant['Description']
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

        foreach ($reviews as $review) {
            array_push($array, new Review(
                (int)$review['ReviewID'],
                (int)$review['Score'],
                $review['ReviewComment'],
                $review['DateOfReview'],
                $review['CustomerID']
            ));
        }

        return $array;
    }

    public static function getRandomRestaurants(PDO $db, int $limit): array
    {

        $restaurants = [];
        $stmt = $db->prepare('
            SELECT *
            FROM Restaurant
            ORDER BY RANDOM()
            LIMIT ?
        ');

        $stmt->execute(array($limit));

        $arr = $stmt->fetchAll();

        foreach ($arr as $restaurant) {
            array_push($restaurants, new Restaurant(
                (int)$restaurant['RestaurantID'], // does the array returned from the querie is always a string ?
                $restaurant['Name'],
                $restaurant['Address'],
                $restaurant['phone'],
                $restaurant['Category'],
                $restaurant['Description']
            ));
        }

        return $restaurants;
    }

    public function getMediumScore(PDO $db): float
    {

        $medium = 0;
        $count = 0;

        $stmt = $db->prepare('
            SELECT Score
            FROM Restaurant LEFT JOIN Review on (Restaurant.RestaurantID = Review.RestaurantID)
            WHERE Restaurant.RestaurantID = ?
        ');

        $stmt->execute(array($this->id));

        $arr = $stmt->fetchAll();

        foreach ($arr as $score) {
            $medium += $score['Score'];
            $count++;
        }

        return (float)number_format((float)$medium / (float)$count, 2, '.', '');
    }

    static function getRestaurantOrders(PDO $db, int $res): array
    {
        $stmt = $db->prepare('
            SELECT *
            FROM "Order"
            WHERE RestaurantID = ?
        ');

        $stmt->execute(array($res));

        $orders = array();

        $arr = $stmt->fetchAll();

        foreach ($arr as $order) {
            array_push($orders, new Order(
                (int)$order['OrderID'], // does the array returned from the querie is always a string ?
                (int)$order['CustomerID'],
                (int)$order['OrderStateID'],
                (int)$order['RestaurantID'],
                (int)$order['CourierID'],
                $order['DateOrder']
            ));
        }
        return $orders;
    }


    static function getRestaurantBySearch(PDO $db, string $query, int $offset = null): array
    {
        $restaurants = [];
        $stmt = $db->prepare('
            SELECT *
            FROM Restaurant
            where Name like "%" || ? || "%"
            LIMIT ?, 4
        ');

        $stmt->execute(array($query, $offset * 4));

        $arr = $stmt->fetchAll();

        foreach ($arr as $restaurant) {
            array_push($restaurants, new Restaurant(
                (int)$restaurant['RestaurantID'],
                $restaurant['Name'],
                $restaurant['Address'],
                $restaurant['phone'],
                $restaurant['Category'],
                $restaurant['Description']
            ));
        }

        return $restaurants;
    }
}
