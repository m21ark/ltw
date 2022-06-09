<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($_SESSION['user']);

$customer = $user->hasPermission('Customer');
if ($customer == null) {
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}


if (isset($_POST['resID'])) {
    $db = getDatabaseConnection();
    $dish = Restaurant::getRestaurant($db, intval(htmlentities($_POST['resID'])));

    $customer->getFavoriteRestaurants($db);
    $customer->removeFromFavoriteRestaurants($db, $dish);
}else if (isset($_POST['dishID'])) {
    $db = getDatabaseConnection();
    $dish = Dish::getDish($db, intval(htmlentities($_POST['dishID'])));

    $customer->getFavoriteDishes($db);
    $customer->removeFromFavoriteDishes($db, $dish);
}

