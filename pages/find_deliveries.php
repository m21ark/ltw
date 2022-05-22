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




function getOrderDishes(PDO $db, $id): array
{
    $stmt = $db->prepare('
        SELECT DishID, count(OrderID) as Qnt
        FROM DishOrder
        WHERE OrderID = ?
        Group by DishID
    ');

    $stmt->execute(array($id));

    return $stmt->fetchAll();
}




output_header();
draw_deliverTaken();
draw_deliveryOptions();
output_footer();
