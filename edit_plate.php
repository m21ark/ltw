<?php
include_once("templates/common.tpt.php");
require_once("database/connection.php");

// TODO should be the rest owner!!!
session_start();
if ($_SESSION['user'] == null) die(header('Location: /'));

$user = unserialize($_SESSION['user']);

if (!isset($_GET['pid'])) {
    die(header('Location: /'));
}

// add mode
if ($_GET['pid'] == 0) {
    output_header();
    drawPlateEdit(null, null, $_GET['restId'], false);
    output_footer();
    die();
}

$db = getDatabaseConnection();
$dish = Dish::getDish($db, $_GET['pid']);

if ($dish === null)
    die(header('Location: /'));


$restaurantID = $dish->getRestaurantID($db);

$isOwner = false;
$owner = isset($user)? $user->hasPermission("RestaurantOwner") : null;
if ($owner !== null){
    $isOwner = $owner->isTheOwner($db, $restaurantID);
}

if (!$isOwner) 
	die(header('location: /'));

$ingredients = $dish->getIngredients($db);

output_header();
drawPlateEdit($dish, $ingredients, $restaurantID, true);
output_footer();
