<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$user = unserialize($_SESSION['user']);
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


unset($_SESSION['user']);

/*
session_start();

require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST["email"], $_POST["password"]);
$_SESSION['user'] = serialize($user);
*/

//______________________________________________________________________________________________________________


die(header("Location: ../user.php?id=" . $user->id));
