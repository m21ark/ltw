<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/restaurant.class.php");

$session = new Session();

$db = getDatabaseConnection();

//   $artists = Artist::searchArtists($db, $_GET['search'], 8);
$dishes = Dish::getRandomDishes($db, 4);

echo json_encode($dishes);
