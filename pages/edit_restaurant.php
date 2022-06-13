<?php
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");
require_once(__DIR__ . "/../templates/restaurant.tpt.php");
require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}


$user = $session->getUser();

if (!isset($_GET['id']))
    die(header('Location: /'));


$uid = $user->permissions[0]->id;
$restaurantID = $_GET['id'];
$db = getDatabaseConnection();


// add mode
if ($_GET['id'] == 0) {
    output_header();
    drawRestEdit(null,  $uid, false);
    output_footer();
    die();
}


require_once(__DIR__ . "/../database/verify_if_owner.php");


$restaurant = Restaurant::getRestaurant($db, $_GET['id']);

if ($restaurant === null) {
    $session->addMessage('erro', 'Ownership required to make changes');
    die(header('Location: /'));
}

output_header();
drawRestEdit($restaurant, $uid, true);
output_footer();
