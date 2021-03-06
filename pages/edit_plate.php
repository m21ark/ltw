<?php
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/plate.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

if (!isset($_GET['pid']))
    die(header('Location: /'));

$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['pid']);
$restaurantID = $_GET['restId'] !== null ? $_GET['restId'] : $dish->getRestaurantID($db);


require_once(__DIR__ . "/../database/verify_if_owner.php");


if ($_GET['pid'] == 0) {
    output_header();
    drawPlateEdit(null, null, $_GET['restId'], false);
    output_footer();
    die();
}

if ($dish === null) {
    $session->addMessage('erro', 'Ownership required to make changes');
    die(header('Location: /'));
}

$ingredients = $dish->getIngredients($db);

output_header();
drawPlateEdit($dish, $ingredients, $restaurantID, true);
output_footer();
