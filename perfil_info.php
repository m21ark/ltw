<?php

declare(strict_types=1);

require_once(__DIR__ . "/database/Users/user_composite.class.php");
require_once(__DIR__ . "/database/Users/customer.class.php");

// Restricts access to logged in users
require_once(__DIR__ . '/utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()){
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($session->getUserSerialized());

$customer = $user->hasPermission("Customer");
$owner = $user->hasPermission("RestaurantOwner");
if ($customer === null && $owner === null) die(header('Location: /'));

require_once("templates/common.tpt.php");
require_once("templates/plates_carrossel.tpt.php");
require_once("templates/restaurants_carrossel.tpt.php");
require_once("database/connection.php");

$db = getDatabaseConnection();

output_header();
if ($owner !== null && $_GET['type'] == 'res') {
    $rests = RestaurantOwner::getOwnerRestaurants($db, $owner->id);
    $oRest = array();
    foreach ($rests as $res) {
        array_push($oRest, Restaurant::getRestaurant($db, (int)$res));
    }

    drawRestaurantsCarrossel($db, $oRest, false);
}

if ($customer != null && $_GET['type'] == 'fav') {

    $dishesID = $customer->getFavoriteDishes($db);
    $restaurantsID = $customer->getFavoriteRestaurants($db);

    $dishes = [];
    $restaurants = [];

    foreach ($restaurantsID as $id)
        array_push($restaurants, Restaurant::getRestaurant($db, (int)$id['RestaurantID']));

    foreach ($dishesID as $id)
        array_push($dishes, Dish::getDish($db, (int)$id['DishID']));

    drawUserFavCards($dishes, $restaurants);
}

output_footer();
