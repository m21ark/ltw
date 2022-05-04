<?php

declare(strict_types=1);

require_once(__DIR__ . "/../restaurant.class.php");
require_once(__DIR__ . "/user.abstract.php");

class Customer extends User
{

    public array $favoriteRestaurants;
    public array $favoriteDishes;
    public array $cart = [];

    public function __construct(int $id, string $username, string $address, string $phone, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    public static function login(PDO $db, string $email, string $password): ?User
    {
        $stmt = $db->prepare('
            SELECT UserID, username, Address, phoneNumber, email
            FROM Customer LEFT JOIN USER on (CustomerID = UserID)
            WHERE lower(email) = ? AND password = ?
      ');

        $stmt->execute(array(strtolower($email), sha1($password)));

        if ($customer = $stmt->fetch()) {
            return new Customer(
                (int)$customer['UserId'],
                $customer['username'],
                $customer['Address'],
                $customer['phoneNumber'],
                $customer['email']
            );
        } else return null;
    }

    public function getFavoriteRestaurants(PDO $db): array
    {
        $stmt = $db->prepare('
            SELECT RestaurantID
            FROM CustomerFavoriteRestaurants
            WHERE CustomerID = ?
      ');

        $stmt->execute(array($this->id));

        $favoriteRestaurants = $stmt->fetchAll();
        return $favoriteRestaurants;
    }

    public function getFavoriteDishes(PDO $db): array
    {
        $stmt = $db->prepare('
            SELECT DishID
            FROM CustomerFavoriteDishes
            WHERE CustomerID = ?
      ');

        $stmt->execute(array($this->id));

        $favoriteDishes = $stmt->fetchAll();
        return $favoriteDishes;
    }

    public function addToFavoriteRestaurants(PDO $db, Restaurant $restaurant): bool
    {
        array_push($favoriteRestaurants, $restaurant->id);

        $stmt = $db->prepare('
            INSERT INTO CustomerFavoriteRestaurants VALUES (?, ?);
        ');

        return $stmt->execute(array($this->id, $restaurant->id));
    }

    public function addToFavoriteDishes(PDO $db, Dish $dish): bool
    {
        array_push($favoriteRestaurants, $dish->id);

        $stmt = $db->prepare('
            INSERT INTO CustomerFavoriteDishes VALUES (?, ?);
        ');

        return $stmt->execute(array($this->id, $dish->id));
    }

    public function removeFromFavoriteDishes(PDO $db, Dish $dish): bool
    {
        unset($favoriteDishes[$dish->id]);

        $stmt = $db->prepare('
            DELETE FROM CustomerFavoriteDishes
            WHERE CustomerID = ? AND DishID = ?);
        ');

        return $stmt->execute(array($this->id, $dish->id));
    }

    public function removeFromFavoriteRestaurants(PDO $db, Restaurant $restaurant): bool
    {
        unset($favoriteRestaurants[$restaurant->id]);

        $stmt = $db->prepare('
            DELETE FROM CustomerFavoriteRestaurants
            WHERE CustomerID = ? AND RestaurantID = ?);
        ');

        return $stmt->execute(array($this->id, $restaurant->id));
    }


    public static function isCustomer(PDO $db, string $email): bool
    {

        $stmt = $db->prepare('
            SELECT  UserID
            FROM Customer LEFT JOIN USER on (CustomerID = UserID)
            WHERE lower(email) = ? 
      ');

        $stmt->execute(array(strtolower($email)));

        if ($customer = $stmt->fetch()) {
            if (empty($customer)) {
                return false;
            }
            return true;
        } else return false;
    }


    public function addToCart(int $dishId) {
        
        if (!in_array($dishId, $this->cart))
            array_push($this->cart, $dishId);
    }

    public function deleteFromCart(int $dishId) {
        $this->cart = \array_diff($this->cart, [$dishId]);
    }
}
