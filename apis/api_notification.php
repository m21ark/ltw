<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/notification.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400');
    if ($_SERVER["CONTENT_TYPE"] == "application/json") {
        header('Content-Type: application/json');

        echo json_encode(Notification::userHasNotification((int)htmlentities($_GET['id'])));
    } else {
        echo json_encode("");
    }
    die();
}

header("HTTP/1.1 400 Bad Request");
