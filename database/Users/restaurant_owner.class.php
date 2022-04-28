<?php

declare(strict_types=1);


require_once(__DIR__ . "/user.abstract.php");
require_once(__DIR__ . "/../restaurant.class.php");
require_once(__DIR__ . "/../order.class.php");
require_once(__DIR__ . '/user.abstract.php');

class RestaurantOwner extends User
{

    public static function login(PDO $db, string $email, string $password): ?User
    {
        $stmt = $db->prepare('
            SELECT UserID, username, Address, phoneNumber, email
            FROM Owner LEFT JOIN USER on (OwnerID = UserID)
            WHERE lower(email) = ? AND password = ?
        ');

        $stmt->execute(array(strtolower($email), sha1($password)));


        if ($customer = $stmt->fetch()) {
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

    //TODO a Function that allows to get all restaurants of a owner


    public function changeOrderStatus(PDO $db, Order $order, OrderStatus $orderStatus): bool
    {

        $stmt = $db->prepare('
            UPDATE "Order"
            SET OrderStateID = ?
            WHERE OrderID = ?);
        ');        

        return $stmt->execute(array($orderStatus,$order->id));;
    }
}
