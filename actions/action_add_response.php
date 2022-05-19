<?php

declare(strict_types=1);

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$db = getDatabaseConnection();

$stmt = $db->prepare("INSERT INTO Response  VALUES (?,  ?) ");


$session->addMessage('sucesso', 'Response was added');

$stmt->execute(array($_POST['id'], $_POST['comment']));
