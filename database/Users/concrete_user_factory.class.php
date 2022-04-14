<?php

    declare(strict_types = 1);

    include_once("user_factory.interface.php");
    include_once("costumer.class.php");
    include_once("restaurant_owner.class.php");
    

    class ConcreteUserFactory implements UserFactory{
        public function getUserAccordingToType(PDO $db, string $email, string $password) : ?User{
            //if we want to add the driver we must do an update here
            // TODO:::: Consider making DB a sigleton to prevent passing it has argument
            if (RestaurantOwner::isOwnerOfRestaurant($db, $email)) {
                return RestaurantOwner::login($db, $email, $password);
            } else { 
                return Costumer::login($db, $email, $password);
            }

            return null;
        }

    }

?>