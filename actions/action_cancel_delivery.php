<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../templates/deliveries.tpt.php");
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$user = unserialize($session->getUserSerialized());

/* Problem checking permissions here.... 

$acess1 = $user->hasPermission("Courier");

if (($acess2 !== 1)) {
    $session->addMessage('erro', 'You dont have owner permissions');
    die(header('Location: /'));
}

 */

$db = getDatabaseConnection();


// ___________________________________________________________________________


$stmt = $db->prepare('UPDATE "Order" SET OrderStateID = ? WHERE OrderID = ?');
$stmt->execute(array(3, $_GET['oid']));

// ___________________________________________________________________________

$session->addMessage('info', 'Delivery canceled');

die(header('Location: ' . $_SERVER['HTTP_REFERER']));
