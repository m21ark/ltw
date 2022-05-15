<?php
include_once("templates/common.tpt.php");
require_once("database/connection.php");

session_start();
if ($_SESSION['user'] == null) die(header('Location: /'));

$user = unserialize($_SESSION['user']);

if (!isset($_GET['pid'])) {
    die(header('Location: /'));
}


$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['pid']);
$restaurantID = $_GET['restId'] !== null ? $_GET['restId'] : $dish->getRestaurantID($db);

// -----------------------------------------------------------

require_once(__DIR__ . "/database/verify_if_owner.php");

// -----------------------------------------------------------


if ($_GET['pid'] == 0) {
    output_header();
    drawPlateEdit(null, null, $_GET['restId'], false);
    output_footer();
    die();
}


if ($dish === null)
    die(header('Location: /'));


$ingredients = $dish->getIngredients($db);

output_header();
drawPlateEdit($dish, $ingredients, $restaurantID, true);
output_footer();
