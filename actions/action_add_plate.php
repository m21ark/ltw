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

if (!isset($_POST['ingredients']))
	die(header('Location: /'));

$ings = $_POST['ingredients'];
$ings = explode(',', $ings);

if (sizeof($ings) == 0)
	die(header('Location: /'));

// __________________________________________________________________

$stmt = $db->prepare("INSERT INTO Dish
    VALUES (NULL, ?,  ?, ?, ?)
");

$stmt->execute(array($_POST['p_name'], $_POST['price'], $_POST['category'], $_POST['description']));

$plateID = $db->lastInsertId();

// __________________________________________________________________

$stmt = $db->prepare("INSERT INTO Menu 
    VALUES (?, ?)
");

$stmt->execute(array($_POST['restID'], $plateID));

// __________________________________________________________________

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

// __________________________________________________________________

$originalFileName = "../docs/food/$plateID.jpg";

unlink($originalFileName);

move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

$session->addMessage('sucesso', 'Plate was added');

die(header("Location: ../pages/plate.php?id=" . $plateID));
