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

/*

    TODO :: I am repeting a lot of code just to check if user has permission, maybe we can create a class that controlls the permissions

*/

$user = unserialize($session->getUserSerialized());

$customer = $user->hasPermission('Customer');
if ($customer == null) {
    $session->addMessage('erro', 'You dont have customer permissions');
    die(header('Location: /'));
}

$customer->deleteFromCart((int)$_POST['id']);

$session->setUser($user);

$session->addMessage('info', 'Item was removed from cart');


