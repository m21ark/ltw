<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

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
