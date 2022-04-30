<?php
include_once("templates/common.tpt.php");
include_once("templates/plates_carrossel.tpt.php");
include_once("templates/restaurant.tpt.php");

require_once("database/connection.php");
require_once("database/restaurant.class.php");


if (!isset($_GET['id'])) {
    die(header('Location: /'));
}


$db = getDatabaseConnection();

$restaurant = Restaurant::getRestaurant($db, $_GET['id']);

if ($restaurant === null)
    die(header('Location: /'));

$menu = $restaurant->getMenu($db);
$dishes = $menu->getMenuDishes($db); // TODO : We need to take the information about the length on the carrossel
// maybe later we can set cokkies that determine the above res/dishes
$reviews = $restaurant->getRestaurantReviews($db);

output_header();
drawRestaurantPresentation($restaurant);
drawPlatesCarrossel($dishes);
drawRestaurantAskReview();
drawRestaurantReviews($reviews);
output_footer();
