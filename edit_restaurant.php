<?php
require_once(__DIR__ . "/templates/common.tpt.php");
require_once(__DIR__ . "/templates/plates_carrossel.tpt.php");
require_once(__DIR__ . "/templates/restaurant.tpt.php");

require_once(__DIR__ . "/database/connection.php");
require_once(__DIR__ . "/database/restaurant.class.php");


// TODO should be the rest owner!!!
session_start();
if ($_SESSION['user'] == null) die(header('Location: /'));


if (!isset($_GET['id'])) {
    die(header('Location: /'));
}

$user = unserialize($_SESSION['user']);
$uid = $user->permissions[0]->id; // TODO verify if done properly

// add mode
if ($_GET['id'] == 0) {
    output_header();
    drawRestEdit(null,  $uid, false);
    output_footer();
    die();
}

$db = getDatabaseConnection();

$restaurant = Restaurant::getRestaurant($db, $_GET['id']);

if ($restaurant === null)
    die(header('Location: /'));

output_header();
drawRestEdit($restaurant, $uid, true);
output_footer();