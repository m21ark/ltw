<?php

declare(strict_types=1);

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()){
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

require_once(__DIR__ . "/../database/Users/user_composite.class.php");

$user = unserialize($_SESSION['user']);

$customer = $user->hasPermission('Customer');
if ($customer == null){
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}

$customer->addToCart((int)$_POST['id']);

$_SESSION['user'] = serialize($user);

$session->addMessage('info', 'Added item to cart');

die(header('Location: ' . $_SERVER['HTTP_REFERER']));
