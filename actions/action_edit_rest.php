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

$restID = $_POST['rID'];

// ___________________________________________________________________________

$stmt = $db->prepare("DELETE FROM Restaurant WHERE RestaurantID=?");
$stmt->execute(array($restID));


$stmt = $db->prepare("INSERT INTO Restaurant
    VALUES (?, ?,  ?, ?, ?, ?)
");
$stmt->execute(array($restID, $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['category'], $_POST['description']));


// _________________________________Add Image_________________________________

$noNewImage = !is_uploaded_file($_FILES['image']['tmp_name']);

$originalFileName = "../docs/restaurant/$restID.jpg";

if (!$noNewImage) {
	unlink($originalFileName);
	move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
}

$session->addMessage('info', 'Restaurant info was updated');

die(header("Location: ../restaurant.php?id=" . $restID));
