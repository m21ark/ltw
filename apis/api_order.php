<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");

$session = new Session();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    if ($_SERVER['HTTP_ORIGIN'] === 'http://localhost:9000/pages/control_center.php') {
        header('Access-Control-Allow-Origin: http://localhost:9000/pages/control_center.php');
        header('Access-Control-Allow-Methods: GET');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Access-Control-Max-Age: 86400');
    } else {
        header("HTTP/1.1 401 Unauthorized");
    }
    die();
}


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $db = getDatabaseConnection();

    $stmt = $db->prepare('
            UPDATE "Order"
            SET OrderStateID = ?
            WHERE OrderID = ?
        ');

    $stmt->execute(array($_GET['st'], $_GET['id']));
} else {
    header("HTTP/1.1 401 Unauthorized"); // CHECK BETTER RESPONSE :: TODO
}
