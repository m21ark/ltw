<?php

declare(strict_types=1);

include_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/Users/user_composite.class.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($session->getUserSerialized());

// maybe later we can set cokkies that determine the above res/dishes

$customer = $user->hasPermission('Customer');
if ($customer == null){
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}

$cart = $customer->cart;

$db = getDatabaseConnection();

output_header();
drawCartList($db, $cart);
output_footer();
