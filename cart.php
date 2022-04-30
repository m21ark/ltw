<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");
require_once("database/restaurant.class.php");

$db = getDatabaseConnection();
$restaurants = Restaurant::getRandomRestaurants($db, 4);
$dishes = Dish::getRandomDishes($db, 4);

// maybe later we can set cokkies that determine the above res/dishes

output_header();
drawCartList();
output_footer();

