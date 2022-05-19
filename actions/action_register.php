<?php

declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

$db = getDatabaseConnection();

$user = new UserComposite();

// register error and go back with the information
if (User::userExists($db, $_POST['email'])) {
    $session->addMessage('erro', 'Email already being used');
    die(header('location: ' . $_SERVER['HTTP_REFERER']));
}


User::saveUser($db, $_POST['username'], $_POST['password'], $_POST['address'], $_POST['phone'], $_POST['email']);

Customer::addCostumer($db, $_POST['email']);


$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST["email"], $_POST["password"]);
$session->setUser($user);

$session->addMessage('sucesso', 'Your account was created. Welcome to our site!');

header('Location: ../user.php');
