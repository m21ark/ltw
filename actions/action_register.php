<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

$db = getDatabaseConnection();

$user = new UserComposite();

if (User::userExists($db, $_POST['email'])) // register error and go back with the information
    die(header('location: ' . $_SERVER['HTTP_REFERER']));

User::saveUser($db, $_POST['username'], $_POST['password'], $_POST['address'], $_POST['phone'], $_POST['email']);

Customer::addCostumer($db, $_POST['email']);

$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST["email"], $_POST["password"]);

$_SESSION['user'] = serialize($user);

header('Location: ../user.php');