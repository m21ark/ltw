<?php

declare(strict_types=1);

require_once(__DIR__ . "/restaurant.class.php");
require_once(__DIR__ . "/Users/user.abstract.php");

class OrderStatus
{
    const  received  = 1;
    const  preparing = 2;
    const  ready     = 3;
    const  taken     = 4;
    const  delivering = 5;
    const  delivered = 6;
    const  canceled = 7;
    const status = ['', 'Received', 'Preparing', 'Ready', 'Taken', 'Delivering', 'Delivered', 'Canceled'];
}

class Order
{
    public int $id;
    public int $user;
    public int $order_state;
    public int $restaurant;
    public int $courier;
    public DateTime $date;

    public function __construct(int $id, int $user, int $order_state, int $restaurant, int $courier, string $date)
    {
        $this->id = $id;
        $this->user = $user;
        $this->order_state = $order_state;
        $this->restaurant = $restaurant;
        $this->courier = $courier;
        $this->date = new DateTime($date);
    }

    public function getDeliveryAddress(PDO $db): string
    {
        $stmt = $db->prepare('
            SELECT Address
            FROM User
            WHERE UserId = ?
        ');

        $stmt->execute(array($this->user));

        return (string)$stmt->fetch()['Address'];
    }

    function getOrderDishes(PDO $db): array
    {
        $stmt = $db->prepare('
            SELECT DishID, count(OrderID) as Qnt
            FROM DishOrder
            WHERE OrderID = ?
            Group by DishID
        ');

        $stmt->execute(array($this->id));

        return $stmt->fetchAll();
    }

    static function getOrderRestaurantID(PDO $db, int $id): int
    {
        $stmt = $db->prepare('
            SELECT RestaurantID
            FROM "Order"
            WHERE OrderID = ?
        ');

        $stmt->execute(array($id));

        return (int)$stmt->fetch()['RestaurantID'];
    }

    public function getRestaurantName(PDO $db): String
    {

        $stmt = $db->prepare('
        SELECT Name
        FROM Restaurant
        WHERE RestaurantID = ?');

        $stmt->execute(array($this->restaurant));

        if ($id = $stmt->fetch()) {
            return (string)$id['Name'];
        } else return 0;
    }

    public static function getOrderLocation(PDO $db, int $Order): array
    {
        $stmt = $db->prepare('
        SELECT *
        FROM OrderLocation
        WHERE OrderID = ?');

        $stmt->execute(array($Order));

        return $stmt->fetch();
    }
}
