<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . "/../templates/plates_carrossel.tpt.php");

$session = new Session();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
    $db = getDatabaseConnection();

    $dishes = Dish::getRandomDishes($db, 4);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if ($_SERVER["CONTENT_TYPE"] == "text/html") {
            header('Content-Type: text/html');
            echo drawPlatesCarrossel($dishes);
        } else {
            echo json_encode($dishes);
        }
    }
    die();
}
