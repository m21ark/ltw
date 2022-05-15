<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");
require_once("database/restaurant.class.php");

if (!isset($_SESSION['user']))
	die(header('location: /'));

$user = unserialize($_SESSION['user']);
$db = getDatabaseConnection();
$dish = Dish::getDish($db, $_GET['id']);
$restaurantID = $dish->getRestaurantID($db);

$isOwner = false;
$owner = isset($user)? $user->hasPermission("RestaurantOwner") : null;

if ($owner !== null){
    $isOwner = $owner->isTheOwner($db, $restaurantID);
}

if ($isOwner) 
	die(header('location: /'));

output_header();
drawMakeReview();
output_footer();
