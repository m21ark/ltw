<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400');
    $db = getDatabaseConnection();

    if (!isset($_GET['q'])) {
        $dishes = Dish::getRandomDishes($db, 4);
        if ($_SERVER["CONTENT_TYPE"] == "text/html") {
            header('Content-Type: text/html');
            echo drawPlatesCarrossel($dishes);
        } else {
            echo json_encode($dishes);
        }
    } else {
        $dishes = Dish::getDishesBySearch(
            $db,
            htmlentities($_GET['q']),
            $_GET['off'] !== null ? (int)htmlentities($_GET['off']) : 0,
            $_GET['cat'] !== null ? htmlentities($_GET['cat']) : null,
            $_GET['rid'] !== null ? htmlentities($_GET['rid']) : null
        );

        if ($_SERVER["CONTENT_TYPE"] == "text/html") {
            header('Content-Type: text/html');
            echo drawPlatesCarrossel($dishes);
        } else {
            echo json_encode($dishes);
        }
    }

    die();
}

header("HTTP/1.1 400 Bad Request");
