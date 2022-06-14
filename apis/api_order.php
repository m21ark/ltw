<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . "/../database/order.class.php");
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $db = getDatabaseConnection();
    $id = (string)ORDER::getOrderRestaurantID($db, (int)htmlentities($_GET['id']));
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('
                UPDATE "Order"
                SET OrderStateID = ?
                WHERE OrderID = ?
            ');

    $stmt->execute(array(htmlentities($_GET['st']), htmlentities($_GET['id'])));


    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = getDatabaseConnection();

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400');

    if ($_SERVER["CONTENT_TYPE"] === "application/json") {
        echo json_encode(Order::getOrderLocation($db, (int)htmlentities($_GET['id'])));
    }

    die();
}

header("HTTP/1.1 400 Bad Request");
