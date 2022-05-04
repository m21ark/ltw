<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");


if (!isset($_GET['id'])) {
    die(header('Location: /'));
}

$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['id']);

if ($dish === null)
    die(header('Location: /'));


$restaurantID = $dish->getRestaurantID($db);

$ingredients = $dish->getIngredients($db);

output_header();
drawPlateInfo($dish, $ingredients, $restaurantID);
output_footer();
