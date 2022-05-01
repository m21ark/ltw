<?php

declare(strict_types = 1);

require_once(__DIR__ . "/database/Users/user_composite.class.php");
require_once(__DIR__ . "/database/Users/customer.class.php");

session_start();

if ($_SESSION['user'] == null) die(header('Location: /')); // TODO: MENSSAGE ERROR OR SOMETHING 

$user = unserialize($_SESSION['user']);

$customer = $user->hasPermission("Customer");
if ($customer === null) die(header('Location: /'));

require_once("templates/common.tpt.php");
require_once("templates/plates_carrossel.tpt.php");
require_once("templates/restaurants_carrossel.tpt.php");
require_once("database/connection.php");



$db = getDatabaseConnection();

$dishesID = $customer->getFavoriteDishes($db);
$restaurantsID = $customer->getFavoriteRestaurants($db);

$dishes = [];
$restaurants = [];

foreach ($restaurantsID as $id) {
    array_push($restaurants, Restaurant::getRestaurant($db, (int)$id['RestaurantID']));
}

foreach ($dishesID as $id) {
    array_push($dishes, Dish::getDish($db, (int)$id['DishID']));
}


output_header();
drawUserFavCards($dishes, $restaurants);
output_footer();
