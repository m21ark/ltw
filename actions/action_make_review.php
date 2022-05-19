<?php

declare(strict_types=1);

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();

$stmt = $db->prepare("INSERT INTO Review 
    VALUES (NULL, ?,  ?, ?, ?, ?)
");


$stmt->execute(array($_POST['rating'], $_POST['review'],  date('Y/m/d', time()), $_POST['id'], $user->permissions[0]->id));

$session->addMessage('sucesso', 'Your review was published');

header("Location: ../restaurant.php?id=" . $_POST['id']);
die();
