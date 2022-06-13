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

$db = getDatabaseConnection();

// ___________________________________________________________________________

$stmt = $db->prepare("INSERT INTO Restaurant
    VALUES (NULL, ?,  ?, ?, ?, ?)
");

$stmt->execute(array($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['category'], $_POST['description']));

$restID = $db->lastInsertId();



$stmt = $db->prepare("INSERT INTO Owner
    VALUES (?, ?)
");

$stmt->execute(array($session->getId(), $restID));

// ___________________________________________________________________________

// Atualizar permissoes para ser owner
$user = $session->getUser()->permissions[0];
$costPriUser = $session->getUser();
array_push($costPriUser->permissions, new RestaurantOwner($user->id, $user->username, $user->address, $user->phone, $user->email));

// ___________________________________________________________________________

$session->setUser($costPriUser);

$originalFileName = "../docs/restaurant/$restID.jpg";

unlink($originalFileName);

move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

$session->addMessage('sucesso', 'Restaurant was added');

die(header("Location: ../pages/restaurant.php?id=" . $restID));
