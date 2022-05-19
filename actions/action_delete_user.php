<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) die(header('Location: /'));

$user = ($session->getUser())->permissions[0];

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
