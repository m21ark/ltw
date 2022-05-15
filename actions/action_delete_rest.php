<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();

$restID = $_GET['rID'];

// ___________________________________________________________________________

$stmt = $db->prepare("DELETE FROM Restaurant WHERE RestaurantID=?");
$stmt->execute(array($restID));

$stmt = $db->prepare("DELETE FROM Owner WHERE RestaurantID=?");
$stmt->execute(array($restID));

// _________________________________Add Image_________________________________


$originalFileName = "../docs/restaurant/$restID.jpg";

unlink($originalFileName);

die(header("Location: ../index.php"));
