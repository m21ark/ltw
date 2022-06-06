<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

if (!isset($_POST['dishID']) || !isset($_POST['qnt']))
    die(header('Location: /'));

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$db = getDatabaseConnection();

$user = unserialize($session->getUserSerialized());

$customer = $user->hasPermission('Customer');
if ($customer == null) {
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}

$cart = $customer->cart;


for ($i = 0; $i < sizeof($cart); $i++)
    if ($cart[$i][0] == $_POST['dishID']) {
        $customer->cart[$i][1] =  $_POST['qnt'];
        break;
    }

$session->setUser($user);
print_r($cart);
