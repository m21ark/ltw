<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/Users/customer.class.php");
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/forms.tpt.php");
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");
require_once(__DIR__ . "/../templates/restaurants_carrossel.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($session->getUserSerialized());

$customer = $user->hasPermission("Customer");
$owner = $user->hasPermission("RestaurantOwner");
$courier = $user->hasPermission("Courier");

if ($customer === null && $owner === null && $courier === null) {
    $session->addMessage('erro', 'You dont have permissions');
    die(header('Location: /'));
}

// FALTA FAZER A PAG DE FAV PARA OS COURIER QUE ADQUIRIRAM ESTATUTO DE CUSTOMER --> Nao esta a funcionar

$db = getDatabaseConnection();

output_header();
if ($owner !== null && $_GET['type'] == 'res') {
    $rests = RestaurantOwner::getOwnerRestaurants($db, $owner->id);
    $oRest = array();
    foreach ($rests as $res)
        array_push($oRest, Restaurant::getRestaurant($db, (int)$res));

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
