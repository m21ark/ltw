<?php

declare(strict_types=1);

session_start();

require_once('../database/connection.php');
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');

$db = getDatabaseConnection();


$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST["email"], $_POST["password"]);

if ($user !== null) 
    $_SESSION['user'] = serialize($user);

// TODO: ELSE RETURN ERROR POP UP


header('Location: ' . $_SERVER['HTTP_REFERER']);
