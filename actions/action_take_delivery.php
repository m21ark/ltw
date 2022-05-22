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


$acess = $user->hasPermission("Courier");
if ($acess === null) {
    $session->addMessage('erro', 'You dont have courier permissions');
    die(header('Location: /'));
}


$db = getDatabaseConnection();

// ___________________________________________________________________________

$stmt = $db->prepare("INSERT INTO TakenDelivery VALUES (?, ?)");

$stmt->execute(array($_GET['oid'], $_GET['cid']));

// ___________________________________________________________________________

$session->addMessage('sucesso', 'Delivery taken');

die(header('Location: ' . $_SERVER['HTTP_REFERER']));
