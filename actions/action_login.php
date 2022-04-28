<?php

declare(strict_types=1);

require_once('../database/connection.php');
require_once('../database/Users/user.abstract.php');
require_once('../database/Users/concrete_user_factory.class.php');

$db = getDatabaseConnection();

session_start();

$user = ConcreteUserFactory::getUserAccordingToType($db, $_POST["email"], $_POST["password"]);

if ($user !== NULL) 
    $_SESSION['user'] = serialize($user);

header('Location: ' . $_SERVER['HTTP_REFERER']);
