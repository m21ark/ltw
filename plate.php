<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");
require_once("database/restaurant.class.php");

$db = getDatabaseConnection();
$restaurants = Restaurant::getRandomRestaurants($db, 4);
$dishes = Dish::getRandomDishes($db, 4);


output_header();
drawPlateInfo();
output_footer();
