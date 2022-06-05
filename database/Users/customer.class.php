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

    public function addToCart(int $dishId)
    {

        // if already exists, increment
        foreach ($this->cart as &$pair) {
            if ($pair[0] === $dishId) {
                $pair[1] = $pair[1] + 1;
                return;
            }
        }

        array_push($this->cart, [$dishId, 1]);

        /*         if (!in_array($dishId, $this->cart))
            array_push($this->cart, $dishId); */
    }

    public function deleteFromCart(int $dishId)
    {

        for ($i = 0; $i < sizeof($this->cart); $i++)
            if ($this->cart[$i][0] === $dishId) {
                \array_splice($this->cart, $i, 1);
                return;
            }
    }

    public function emptyCart()
    {
        $this->cart = array();
    }


    public static function addCostumer(PDO $db, string $email)
    {
        $stmt = $db->prepare('
            SELECT  UserID
            FROM User
            WHERE lower(email) = ? 
      ');

        $stmt->execute(array(strtolower($email)));

        $stmt2 = $db->prepare('
            INSERT INTO CUSTOMER VALUES (?)
      ');

        $stmt2->execute(array($stmt->fetch()['UserId']));
    }

    public static function addCostumerById(PDO $db, int $id)
    {

        $stmt2 = $db->prepare('
            INSERT INTO CUSTOMER VALUES (?)
      ');

        $stmt2->execute(array($id));
    }

    function getCustomerOrders(PDO $db): array
    {
        $stmt = $db->prepare('
            SELECT *
            FROM "Order"
            WHERE CustomerID = ?
        ');

        $stmt->execute(array($this->id));

        $orders = array();

        $arr = $stmt->fetchAll();

        foreach ($arr as $order) {
            array_push($orders, new Order(
                (int)$order['OrderID'],
                (int)$order['CustomerID'],
                (int)$order['OrderStateID'],
                (int)$order['RestaurantID'],
                (int)$order['CourierID'],
                $order['DateOrder']
            ));
        }
        return $orders;
    }


}
