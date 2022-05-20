<?php

include_once(__DIR__ . "/../templates/common.tpt.php");
include_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");
include_once(__DIR__ . "/../templates/restaurants_carrossel.tpt.php");
include_once(__DIR__ . "/../templates/search.tpt.php");
require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");

$db = getDatabaseConnection();
$restaurants = Restaurant::getRandomRestaurants($db, 4);
$dishes = Dish::getRandomDishes($db, 4);

// maybe later we can set cokkies that determine the above res/dishes
output_header();
drawSearchBox();

if (isset($_GET['q']))
    drawSearchResults($restaurants, $dishes);

drawRestaurantsCarrossel($db, $restaurants);
drawPlatesCarrossel($dishes);
output_footer();
