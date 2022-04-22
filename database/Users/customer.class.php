<?php

declare(strict_types=1);

include_once("../restaurant.class.php");

class Customer extends User
{

    public array $favoriteRestaurants;
    public array $favoriteDishes;

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
                $customer['UserId'],
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

        return $stmt->fetchAll();
    }

    public function getFavoriteDishes(PDO $db): array
    {
        $stmt = $db->prepare('
            SELECT DishID
            FROM CustomerFavoriteDishes
            WHERE CustomerID = ?
      ');

        $stmt->execute(array($this->id));

        return $stmt->fetchAll();
    }

    public function addToFavoriteRestaurants(Restaurant $restaurant): void
    {
        array_push($favoriteRestaurants, $restaurant);

        // Save to database
    }

    public function addToFavoriteDishes(Dish $dish): void
    {
        array_push($favoriteRestaurants, $dish);

        // Save to database
    }

    public function removeFromFavoriteDish(Dish $dish): void
    {
        unset($favoriteDishes[$dish]);

        //remove from database
    }

    public function removeFromFavoriteRestaurant(Restaurant $restaurant): void
    {
        unset($favoriteRestaurants[$restaurant]);

        //remove from database
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
}
