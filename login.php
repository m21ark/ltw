<?php
include_once("templates/common.tpt.php");
include_once("templates/login.tpt.php");

require_once("database/connection.php");


$db = getDatabaseConnection();
$restaurants = Restaurant::getRandomRestaurants($db, 4);
$dishes = Dish::getRandomDishes($db, 4);


output_header();
drawLogin();
output_footer();
