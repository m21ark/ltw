<?php

declare(strict_types=1);


require_once(__DIR__ . "/user.abstract.php");
require_once(__DIR__ . "/../restaurant.class.php");
require_once(__DIR__ . "/../order.class.php");

class RestaurantOwner extends User
{

    public static function login(PDO $db, string $email, string $password): ?User
    {

        $stmt = $db->prepare('
            SELECT UserID, username, Address, phoneNumber, email, password
            FROM Owner LEFT JOIN USER on (OwnerID = UserID)
            WHERE lower(email) = ?
        ');

        $stmt->execute(array(strtolower($email)));

        $user = $stmt->fetch();

        if (!($user && password_verify($password, $user['password'])))
            return null;

        if ($customer = $user) {
            return new RestaurantOwner(
                (int)$customer['UserId'],
                $customer['username'],
                $customer['Address'],
                $customer['phoneNumber'],
                $customer['email']
            );
        } else return null;
    }

    public static function isOwnerOfRestaurant(PDO $db, string $email): bool
    {
        $stmt = $db->prepare('
            SELECT OwnerID
            FROM Owner LEFT JOIN USER on (OwnerID = UserID)
            WHERE lower(email) = ? 
      ');

        $stmt->execute(array(strtolower($email)));

        if ($owner = $stmt->fetch()) {
            if (empty($owner)) {
                return false;
            }
            return true;
        } else return false;
    }

    public static function getOwnerRestaurants(PDO $db, int $id): array
    {
        $stmt = $db->prepare('
        SELECT RestaurantID
        FROM Owner
        WHERE OwnerID = ?
    ');
        $stmt->execute(array($id));

        $array = $stmt->fetchAll();
        $rests = array();
        foreach ($array as $rest) {
            array_push($rests, $rest['RestaurantID']);
        }
        return $rests;
    }

    public function isTheOwner(PDO $db, int $restaurantID): bool
    {
        $isOwner = false;
        $restaurants = RestaurantOwner::getOwnerRestaurants($db, $this->id);
        foreach ($restaurants as $res) {
            if ($res == $restaurantID)
                $isOwner = true;
        }
        return $isOwner;
    }

    public function changeOrderStatus(PDO $db, Order $order, OrderStatus $orderStatus): bool
    {

        $stmt = $db->prepare('
            UPDATE "Order"
            SET OrderStateID = ?
            WHERE OrderID = ?);
        ');

        return $stmt->execute(array($orderStatus, $order->id));
    }
}
