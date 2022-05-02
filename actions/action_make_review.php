<?php
declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();

$stmt = $db->prepare("INSERT INTO Review 
    VALUES (NULL, ?,  ?, ?, ?, ?)
");


$stmt->execute(array($_POST['rating'],$_POST['review'],  date('Y/m/d', time()), $_POST['id'], $user->permissions[0]->id));

header("Location: ../restaurant.php?id=" . $_POST['id']);
die();