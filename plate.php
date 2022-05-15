<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");


if (!isset($_GET['id'])) {
    die(header('Location: /'));
}

if (isset($_SESSION['user']))
    $user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['id']);

if ($dish === null)
    die(header('Location: /'));

$restaurantID = $dish->getRestaurantID($db);

$ingredients = $dish->getIngredients($db);

$isOwner = false;
$owner = isset($_SESSION['user'])? $user->hasPermission("RestaurantOwner") : NULL;
if ($owner !== NULL){
    $isOwner = $owner->isTheOwner($db, $restaurantID);
}

output_header();
drawPlateInfo($dish, $ingredients, $restaurantID, $isOwner);
output_footer();
