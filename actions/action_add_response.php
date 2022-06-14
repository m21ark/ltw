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

if (!isset($_POST['id']) || !isset($_POST['comment']))
    die(header('Location: /'));

$db = getDatabaseConnection();

$stmt = $db->prepare("INSERT INTO Response  VALUES (?,  ?) ");

$stmt->execute(array($_POST['id'], $_POST['comment']));
