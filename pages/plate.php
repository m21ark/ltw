<?php
include_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . '/../utils/session.php');

if (!isset($_GET['id']))
    die(header('Location: /'));

$session = new Session();
if ($session->isLoggedIn())
    $user = unserialize($session->getUserSerialized());

$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['id']);

if ($dish === null)
    die(header('Location: /'));

$restaurantID = $dish->getRestaurantID($db);
$ingredients = $dish->getIngredients($db);

$isOwner = false;
$owner = $session->isLoggedIn() ? $user->hasPermission("RestaurantOwner") : NULL;
if ($owner !== NULL)
    $isOwner = $owner->isTheOwner($db, $restaurantID);


output_header();
drawPlateInfo($dish, $ingredients, $restaurantID, $isOwner);
output_footer();
