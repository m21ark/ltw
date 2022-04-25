<?php

declare(strict_types=1);


include_once("user.interface.php");
include_once("../restaurant.class.php");
include_once("../order.class.php");

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
                $customer['UserId'],
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

        $stmt->execute(array($orderStatus,$order->id));


        return false;
    }
}
