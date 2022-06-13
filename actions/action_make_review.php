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

$user = unserialize($_SESSION['user']);

$db = getDatabaseConnection();

$stmt = $db->prepare("INSERT INTO Review 
    VALUES (NULL, ?,  ?, ?, ?, ?)
");

$stmt->execute(array($_POST['rating'], $_POST['review'],  date('Y/m/d', time()), $_POST['id'], $user->permissions[0]->id));

$reviewID = $db->lastInsertId();

// _____________________________________________________________________________________________

$originalFileName = "../docs/reviews/" . $reviewID . ".jpg";

unlink($originalFileName);

move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

// _____________________________________________________________________________________________

$session->addMessage('sucesso', 'Your review was published');

header("Location: ../pages/restaurant.php?id=" . $_POST['id']);
