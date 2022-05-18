<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) die(header('Location: /'));


$db = getDatabaseConnection();

$ings = $_POST['ingredients'];
$ings = explode(',', $ings);

$plateID = $_POST['plateID'];

$noNewImage = !is_uploaded_file($_FILES['image']['tmp_name']);

// _________________________________add to dishes_________________________________

$stmt = $db->prepare("DELETE FROM DISH WHERE DishID=?");
$stmt->execute(array($plateID));



$stmt = $db->prepare("INSERT INTO Dish
    VALUES (?, ?,  ?, ?, ?)
");
$stmt->execute(array($plateID, $_POST['p_name'], $_POST['price'], $_POST['category'], $_POST['description']));

// _________________________________add to Restaurant Menu_________________________________

$stmt = $db->prepare("DELETE FROM Menu WHERE DishID=?");
$stmt->execute(array($plateID));


$stmt = $db->prepare("INSERT INTO Menu 
    VALUES (?, ?)
");
$stmt->execute(array($_POST['restID'], $plateID));

// _________________________________Add Ingredients_________________________________

$stmt = $db->prepare("DELETE FROM DishIngredients WHERE DishID=?");
$stmt->execute(array($plateID));

foreach ($ings as $ing) {

	$stmt = $db->prepare("INSERT INTO Ingredient
    VALUES (null, ?)
	");
	$stmt->execute(array($ing));


	$ingID = $db->lastInsertId();

	$stmt = $db->prepare("INSERT INTO DishIngredients 
    VALUES (?, ?)
	");
	$stmt->execute(array($plateID, $ingID));
}

// _________________________________Add Image_________________________________


$originalFileName = "../docs/food/$plateID.jpg";

if (!$noNewImage) {
	unlink($originalFileName);
	move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
}

die(header("Location: ../plate.php?id=" . $plateID));
