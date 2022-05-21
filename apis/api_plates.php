<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");
require_once(__DIR__ . '/../utils/session.php');

// $session = new Session();
// if (!$session->isLoggedIn()) {
//     $session->addMessage('erro', 'Login required. Redirected to main page');
//     die(header('Location: /'));
// }


$db = getDatabaseConnection();

//   $artists = Artist::searchArtists($db, $_GET['search'], 8);
$dishes = Dish::getRandomDishes($db, 4);

echo json_encode($dishes);
