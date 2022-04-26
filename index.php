<?php
include_once("templates/common.tpt.php");
include_once("templates/plates_carrossel.tpt.php");
include_once("templates/restaurants_carrossel.tpt.php");
include_once("templates/search.tpt.php");

require_once("database/connection.php");
require_once("database/restaurant.class.php");

$db = getDatabaseConnection();
$restaurants = Restaurant::getRandomRestaurants($db, 4);

output_header();
drawSearchScreen();
drawRestaurantsCarrossel($restaurants);
drawPlatesCarrossel(array());
output_footer();
