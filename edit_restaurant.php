<?php
require_once(__DIR__ . "/templates/common.tpt.php");
require_once(__DIR__ . "/templates/plates_carrossel.tpt.php");
require_once(__DIR__ . "/templates/restaurant.tpt.php");

require_once(__DIR__ . "/database/connection.php");
require_once(__DIR__ . "/database/restaurant.class.php");


// TODO should be the rest owner!!!
session_start();
if ($_SESSION['user'] == null) die(header('Location: /'));


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
drawRestaurantDescriptionName($db, $restaurant);
drawRestaurantDescription($restaurant);
drawPlatesCarrossel($dishes);
drawRestaurantAskReview($restaurant);
drawRestaurantReviews($db, $reviews);
output_footer();
