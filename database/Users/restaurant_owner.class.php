<?php

    declare(strict_types = 1);


    include_once("user.interface.php");
    include_once("../restaurant.class.php");
    include_once("../order.class.php");

    class RestaurantOwner extends User {

        public static function login(PDO $db, string $email, string $password) : ?User {
            //TODO :: maybe this can be non-abstract ... depends on the schema of the db 
            
            return null;
        }

        public static function isOwnerOfRestaurant(PDO $db, string $email) :bool{
            // in the schema we must have a table in the form (Restaurant id, User id)
            // then we can see how many restaurants he has and put a array with those values
            return false;
        }

        //TODO a Function that allows to get all restaurants of a owner


        public function changeOrderStatus(PDO $db, Order $order) :bool {

            //database

            
            return false;
        }

    }

?>