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

$user = $session->getUser();
$user = $user->permissions[0];

$db = getDatabaseConnection();


// _____________________________________________________________________________________________

$stmt = $db->prepare("DELETE FROM User WHERE UserId=?");
$stmt->execute(array($user->id));


$password = password_hash($_POST['new_password'], PASSWORD_DEFAULT, ['cost' => 12]);


$stmt = $db->prepare("INSERT INTO User VALUES (?, ?,  ?, ?, ?, ?, null)");
$stmt->execute(array($user->id, strtolower($_POST['email']), $_POST['username'], $password, $_POST['address'], $_POST['phone']));


// _____________________________________________________________________________________________


$noNewImage = !is_uploaded_file($_FILES['image']['tmp_name']);

$originalFileName = "../docs/users/$user->id.jpg";

if (!$noNewImage) {
	unlink($originalFileName);

	move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
}

// _____________________________________________________________________________________________


$session->logout();
$session = new Session();

require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST['email'], $_POST['new_password']);

$session->setUser($user);

// _____________________________________________________________________________________________

$session->addMessage('info', 'User settings were updated');

die(header("Location: ../pages/user.php?id=" . $user->permissions[0]->id));
