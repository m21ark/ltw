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

$db = getDatabaseConnection();


require_once(__DIR__ . "/../database/verify_if_owner.php");


// TODO Should Restaurant Menu, Orders be also deleted? --> Maybe to much work and can cause inconsistencies at this late game


// ___________________________________________________________________________

$stmt = $db->prepare("DELETE FROM Restaurant WHERE RestaurantID=?");
$stmt->execute(array($restaurantID));

$stmt = $db->prepare("DELETE FROM Owner WHERE RestaurantID=?");
$stmt->execute(array($restaurantID));

// ___________________________________________________________________________

$originalFileName = "../docs/restaurant/$restaurantID.jpg";

unlink($originalFileName);


$session->addMessage('sucesso', 'Restaurant was removed');

die(header("Location: /"));
