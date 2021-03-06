<?php
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");
require_once(__DIR__ . "/../templates/restaurant.tpt.php");
require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");

if (!isset($_GET['id'])) {
    die(header('Location: /'));
}

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if ($session->isLoggedIn())
    $user = unserialize($session->getUserSerialized());

$db = getDatabaseConnection();

$restaurant = Restaurant::getRestaurant($db, $_GET['id']);


if ($restaurant === null)
    die(header('Location: /'));

$menu = $restaurant->getMenu($db);
$dishes = Dish::getDishesBySearch(
    $db,
    "",
    0,
    $_GET['cat'] !== null ? htmlentities($_GET['cat']) : null,
    $_GET['id'] !== null ? htmlentities($_GET['id']) : null
);


$reviews = $restaurant->getRestaurantReviews($db);

$isOwner = false;
$owner = $session->isLoggedIn() ? $user->hasPermission("RestaurantOwner") : NULL;
$customer = $session->isLoggedIn() ? $user->hasPermission("Customer") : NULL;

if ($owner !== NULL)
    $isOwner = $owner->isTheOwner($db, $restaurant->id);

output_header();
drawRestaurantDescriptionName($db, $restaurant);
drawRestaurantDescription($restaurant, $isOwner, $customer);
drawPlatesCarrossel($dishes);

if ($isOwner)
    drawRestaurantOwnerReview($restaurant);
else
    drawRestaurantAskReview($restaurant);

drawRestaurantReviews($db, $reviews, $isOwner);
output_footer();
