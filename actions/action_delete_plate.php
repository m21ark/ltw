<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) die(header('Location: /'));


$db = getDatabaseConnection();

$plateID = $_GET['pid'];


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

die(header("Location: ../restaurant.php?id=" . $_GET['rest_id']));
