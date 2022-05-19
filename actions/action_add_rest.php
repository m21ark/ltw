<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()){
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

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

$session->addMessage('sucesso', 'Restaurant was added');

die(header("Location: ../restaurant.php?id=" . $restID));
