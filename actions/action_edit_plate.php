<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();


die(); // TO BE DONE


// _________________________________add to dishes_________________________________

$stmt = $db->prepare("INSERT INTO Dish 
    VALUES (NULL, ?,  ?, ?, ?)
");

$stmt->execute(array($_POST['name'], $_POST['price'], $_POST['category']));

$plateID = $db->lastInsertId();


// _________________________________add to Restaurant Menu_________________________________

$stmt = $db->prepare("INSERT INTO Menu 
    VALUES (?, ?)
");

$stmt->execute(array($_POST['restID'], $plateID));


// _________________________________Add Ingredients_________________________________

$num_ings = 3;

for ($i = 0; $i < $num_ings; $i++) {

	// make drop down option with built in ingridients insted of creating new ones

	$stmt = $db->prepare("INSERT INTO DishIngredients 
    VALUES (?, ?)
	");
	$stmt->execute(array($plateID, $_POST['ing' . $i]));
}






die(header("Location: ../restaurant.php?id=" . $_POST['id']));
