<?php


include_once("templates/common.tpt.php");
require_once("database/connection.php");
require_once("database/restaurant.class.php");

// Restricts access to logged in users
require_once(__DIR__ . '/utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()){
	$session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}


$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['id']);
$restaurantID = $dish->getRestaurantID($db);


$user = unserialize($session->getUserSerialized());

$isOwner = false;
$owner = isset($user) ? $user->hasPermission("RestaurantOwner") : null;

if ($owner !== null)
	$isOwner = $owner->isTheOwner($db, $restaurantID);

if ($isOwner)
	die(header('location: /'));

output_header();
drawMakeReview();
output_footer();
