<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();


$uid = 20; //Here It should be a verified owner id recieved by $_POST["uid"]


// ___________________________________________________________________________

$stmt = $db->prepare("INSERT INTO Restaurant
    VALUES (NULL, ?,  ?, ?, ?, ?)
");

$stmt->execute(array($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['category'], $_POST['description']));

$restID = $db->lastInsertId();



$stmt = $db->prepare("INSERT INTO Owner
    VALUES (?, ?)
");

$stmt->execute(array($_POST['uid'], $restID));


// _________________________________Add Image_________________________________


$originalFileName = "../docs/restaurant/$restID.jpg";

unlink($originalFileName);

move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

die(header("Location: ../restaurant.php?id=" . $restID));
