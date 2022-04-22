<?php

    declare(strict_types = 1);

    include_once("restaurant.class.php");
    include_once("Users/user.interface.php");

    class OrderStatus {
        const  received  = 0;
        const  preparing = 1;
        const  ready     = 2;
        const  delivered = 3;
    }

    class Order {
        public int $id;
        public User $user;
        public OrderStatus $order_state;
        public Restaurant $restaurant;
    }
