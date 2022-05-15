<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);
$user = $user->permissions[0];

$db = getDatabaseConnection();


// TODO Check if other stuff like Owner or orders should be also deleted

// __________________________________________________________________

$stmt = $db->prepare("DELETE FROM User WHERE UserId=?");
$stmt->execute(array($user->id));

// __________________________________________________________________


$originalFileName = "../docs/users/$user->id.jpg";

unlink($originalFileName);

unset($_SESSION['user']);

die(header("Location: ../index.php"));
