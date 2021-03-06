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


$db = getDatabaseConnection();

if (!isset($_GET['pid']))
    die(header('Location: /'));

if (!preg_match("/^[0-9]+$/", $_GET['pid'], $plateID))
    die(header('Location: /'));

$plateID =  $plateID[0];

// __________________________________________________________________

$stmt = $db->prepare("DELETE FROM DISH WHERE DishID=?");
$stmt->execute(array($plateID));

$stmt = $db->prepare("DELETE FROM Menu WHERE DishID=?");
$stmt->execute(array($plateID));

$stmt = $db->prepare("DELETE FROM DishIngredients WHERE DishID=?");
$stmt->execute(array($plateID));

// __________________________________________________________________

$originalFileName = "../docs/food/$plateID.jpg";

unlink($originalFileName);

$session->addMessage('sucesso', 'Plate was removed');

die(header("Location: ../pages/restaurant.php?id=" . $_GET['rest_id']));
