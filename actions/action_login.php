<?php

declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/Users/concrete_user_factory.class.php');
require_once(__DIR__ . '/../utils/session.php');

$session = new Session();

$db = getDatabaseConnection();

$user = ConcreteUserFactory::getUserAccordingToType($db, (string)$_POST["email"], $_POST["password"]);


if ($user !== null) {
    $session->setUser($user);
    $session->addMessage('sucesso', 'Login successful!');
    die(header('Location: /'));
} else
    $session->addMessage('erro', 'Wrong password!');

die(header('Location: ' . $_SERVER['HTTP_REFERER']));
