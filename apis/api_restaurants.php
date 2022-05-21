<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . "/../templates/restaurants_carrossel.tpt.php");

$session = new Session();
//if (!$session->isLoggedIn()) {
//    $session->addMessage('erro', 'Login required. Redirected to main page');
//    die(header('Location: /'));
//}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
    die();
}

$db = getDatabaseConnection();

$restaurants = Restaurant::getRandomRestaurants($db, 4);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET['response'] === "html") {
        header('Content-Type: text/html');
        echo drawRestaurantsCarrossel($db, $restaurants);
    } else {

        //   $artists = Artist::searchArtists($db, $_GET['search'], 8);

        echo json_encode($restaurants);
    }
}
