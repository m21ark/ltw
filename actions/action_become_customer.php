<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/Users/customer.class.php");
require_once(__DIR__ . '/../utils/session.php');

$session = new Session();

$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$db = getDatabaseConnection();

$costPriUser = unserialize($session->getUserSerialized());
$user = $costPriUser->permissions[0];


array_push($costPriUser->permissions, new Customer($user->id, $user->username, $user->address, $user->phone, $user->email));

Customer::addCostumerById($db, (int)$_POST['id']);

$session->setUser($costPriUser);
