<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($session->getUserSerialized());
$restaurantID = $_GET['rID'];

// -----------------------------------------------------------

require_once(__DIR__ . "/../database/verify_if_owner.php");

// -----------------------------------------------------------



$db = getDatabaseConnection();

$restID = $_GET['rID'];

// TODO Should Restaurant Menu, Orders be also deleted?

// ___________________________________________________________________________

$stmt = $db->prepare("DELETE FROM Restaurant WHERE RestaurantID=?");
$stmt->execute(array($restID));

$stmt = $db->prepare("DELETE FROM Owner WHERE RestaurantID=?");
$stmt->execute(array($restID));

// _________________________________Add Image_________________________________


$originalFileName = "../docs/restaurant/$restID.jpg";

unlink($originalFileName);


$session->addMessage('sucesso', 'Restaurant was removed');

die(header("Location: /"));
