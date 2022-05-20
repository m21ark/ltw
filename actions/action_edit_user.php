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

$user = $session->getUser();
$user = $user->permissions[0];

$db = getDatabaseConnection();

// TODO ver se par $_POST['old_password'] e $_POST['email']  formam um login valido antes de alterar a password!

/*
if ($login === null) {
	die(header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=1'));
}
*/


// __________________________________________________________________

$stmt = $db->prepare("DELETE FROM User WHERE UserId=?");
$stmt->execute(array($user->id));



$stmt = $db->prepare("INSERT INTO User VALUES (?, ?,  ?, ?, ?, ?, null)");
$stmt->execute(array($user->id, strtolower($_POST['email']), $_POST['username'], sha1($_POST['new_password']), $_POST['address'], $_POST['phone']));


// __________________________________________________________________


$noNewImage = !is_uploaded_file($_FILES['image']['tmp_name']);

$originalFileName = "../docs/users/$user->id.jpg";

if (!$noNewImage) {
	unlink($originalFileName);

	move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);
}



//____________________________________________LOGIN BACK IN__________________________________________________


$session->logout();
$session = new Session();

require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST['email'], $_POST['new_password']);

$session->setUser($user);

//______________________________________________________________________________________________________________

$session->addMessage('info', 'User settings were updated');

die(header("Location: ../pages/user.php?id=" . $user->permissions[0]->id));
