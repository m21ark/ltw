<?php

declare(strict_types=1);

use function PHPSTORM_META\type;

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

if (!isset($_POST['id']))
    die(header('Location: /'));

if (!preg_match("/^[0-9]+$/", $_POST['id'], $match_id))
    die(header('Location: /'));

if ($_POST['type'] == "Customer") {
    array_push($costPriUser->permissions, new Customer($user->id, $user->username, $user->address, $user->phone, $user->email));

    Customer::addCostumerById($db, (int)$match_id[0]);
} else if ($_POST['type'] == "Courier") {
    array_push($costPriUser->permissions, new Courier($user->id, $user->username, $user->address, $user->phone, $user->email));

    Courier::addCourierById($db, (int)$match_id[0]);
}

$session->setUser($costPriUser);
