<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . "/../templates/restaurants_carrossel.tpt.php");

$session = new Session();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400');
    $db = getDatabaseConnection();
    if (!isset($_GET['q'])) {
        $restaurants = Restaurant::getRandomRestaurants($db, 4);
        if ($_SERVER["CONTENT_TYPE"] == "text/html") {
            header('Content-Type: text/html');
            echo drawRestaurantsCarrossel($db, $restaurants);
        } else {
            echo json_encode($restaurants);
        }
    } else {
        $restaurants = Restaurant::getRestaurantBySearch(
            $db,
            htmlentities($_GET['q']),
            $_GET['off'] !== null ? (int)htmlentities($_GET['off']) : 0
        );
        if ($_SERVER["CONTENT_TYPE"] == "text/html") {
            header('Content-Type: text/html');
            echo drawRestaurantsCarrossel($db, $restaurants);
        } else {
            echo json_encode($restaurants);
        }
    }

    die();
}
