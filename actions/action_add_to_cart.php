<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($_SESSION['user']);

$customer = $user->hasPermission('Customer');
if ($customer == null) {
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}

if (!isset($_POST['id']))
    die(header('Location: /'));

if (!preg_match("/^[0-9]+$/", $_POST['id'], $match_id))
    die(header('Location: /'));

$customer->addToCart((int)$match_id[0]);

$_SESSION['user'] = serialize($user);

$session->addMessage('info', 'Added item to cart');

die(header('Location: ' . $_SERVER['HTTP_REFERER']));
