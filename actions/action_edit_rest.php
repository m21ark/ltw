<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();

$uid = 20; //Here It should be a verified owner id recieved by $_POST["uid"]
$restID = $_POST['rID'];

// ___________________________________________________________________________

$stmt = $db->prepare("DELETE FROM Restaurant WHERE RestaurantID=?");
$stmt->execute(array($restID));


$stmt = $db->prepare("INSERT INTO Restaurant
    VALUES (?, ?,  ?, ?, ?, ?)
");
$stmt->execute(array($restID, $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['category'], $_POST['description']));


$stmt = $db->prepare("DELETE FROM Owner WHERE RestaurantID=?");
$stmt->execute(array($restID));

$stmt = $db->prepare("INSERT INTO Owner
    VALUES (?, ?)
");

$stmt->execute(array($_POST['uid'], $restID));


// _________________________________Add Image_________________________________

$noNewImage = !is_uploaded_file($_FILES['image']['tmp_name']);

$originalFileName = "../docs/restaurant/$restID.jpg";

if (!$noNewImage) {
	unlink($originalFileName);

	move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
}

die(header("Location: ../restaurant.php?id=" . $restID));
