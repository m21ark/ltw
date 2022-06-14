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

$user = $session->getUser();

$db = getDatabaseConnection();

if ($_GET['deliv'] == "true") {

    $stmt = $db->prepare('UPDATE "Order" SET OrderStateID = ? WHERE OrderID = ? AND CourierID = ?');
    $stmt->execute(array(3, $_GET['oid'], $user->permissions[0]->id));
    $session->addMessage('info', 'Delivery canceled');
    
} else if ($_GET['deliv'] == "false") {

    $stmt = $db->prepare('SELECT RestaurantID FROM "Order" WHERE OrderID = ?');
    $stmt->execute(array($_GET['oid']));
    $id = $stmt->fetch();
    $res = RestaurantOwner::getOwnerRestaurants($db, $user->permissions[0]->id);

    if (!(in_array($id["RestaurantID"], $res))) {
        $session->addMessage('erro', 'You dont have owner permissions');
        die(header('Location: /'));
    }

    $stmt = $db->prepare('UPDATE "Order" SET OrderStateID = ? WHERE OrderID = ?');
    $stmt->execute(array(7, $_GET['oid']));
    $session->addMessage('info', 'Order canceled');

} else if ($_GET['deliv'] == "user") {

    $stmt = $db->prepare('UPDATE "Order" SET OrderStateID = ? WHERE OrderID = ?');
    $stmt->execute(array(7, $_GET['oid']));
    $session->addMessage('info', 'Order canceled');
}


die(header('Location: ' . $_SERVER['HTTP_REFERER']));
