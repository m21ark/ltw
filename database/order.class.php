<?php

declare(strict_types=1);

require_once(__DIR__ . "/restaurant.class.php");
require_once(__DIR__ . "/Users/user.abstract.php");

class OrderStatus
{
    const  received  = 0;
    const  preparing = 1;
    const  ready     = 2;
    const  delivered = 3;
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

}
