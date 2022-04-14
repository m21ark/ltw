<?php

    declare(strict_types = 1);

    include_once("../restaurant.class.php");

    class Costumer extends User{
        
        public array $favoriteRestaurants;
        public array $favoriteDishes;

        public static function login(PDO $db, string $email, string $password) : ?User {
            // TODO
            return null;
        }

        public function addToFavoriteRestaurants(Restaurant $restaurant) : void {
            array_push($favoriteRestaurants, $restaurant);

            // Save to database
        }

        public function addToFavoriteDishes(Dish $dish) : void {
            array_push($favoriteRestaurants, $dish);

            // Save to database
        }

        public function removeFromFavoriteDish(Dish $dish) : void {
            unset($favoriteDishes[$dish]);

            //remove from database
        }

        public function removeFromFavoriteRestaurant(Restaurant $restaurant) : void {
            unset($favoriteRestaurants[$restaurant]);

            //remove from database
        }

    }

?>