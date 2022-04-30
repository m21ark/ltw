<?php

require_once("templates/common.tpt.php");
require_once("templates/plates_carrossel.tpt.php");
require_once("templates/restaurants_carrossel.tpt.php");
require_once("database/connection.php");

$db = getDatabaseConnection();

$dishes = Dish::getRandomDishes($db, 5);
$restaurants = Restaurant::getRandomRestaurants($db, 5);

output_header();
drawUserFavCards($dishes, $restaurants);
output_footer();
