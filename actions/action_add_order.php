<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
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

function getRestaurantID(PDO $db, $dishID): int
{
    $stmt = $db->prepare('SELECT restaurantID FROM Menu WHERE DishID = ?');
    $stmt->execute(array($dishID));

    if ($id = $stmt->fetch()) {
        return (int)$id['RestaurantID'];
    } else return 0;
}


$prevRest = -1;
$OrderID = -1;
for ($i = 0; $i < sizeof($cart); $i++) {

    $dishID = $cart[$i][0];
    $dishQnt = $cart[$i][1];
    $restID = getRestaurantID($db, $dishID);

    if ($restID == 0) continue;

    if (($prevRest == -1) || ($restID != $prevRest)) {
        $stmt = $db->prepare("INSERT INTO 'Order' VALUES (NULL, ?,  ?, ?, ?, ?) ");
        $stmt->execute(array('2022-06-20 10:00:00', 1, $customer->id, $restID, 0));
        $prevRest = $restID;
        $OrderID = $db->lastInsertId();
    }

    for ($j = 0; $j < $dishQnt; $j++) {
        $stmt = $db->prepare("INSERT INTO DishOrder  VALUES (?, ?) ");
        $stmt->execute(array($dishID, $OrderID));
    }
}


$customer->emptyCart();

$session->setUser($user);

$session->addMessage('sucesso', 'Order was placed');

die(header('Location: ' . $_SERVER['HTTP_REFERER']));
