<?php

$isOwner = false;
$owner = isset($_SESSION['user'])? $user->hasPermission("RestaurantOwner") : null;
if ($owner !== null){
    $isOwner = $owner->isTheOwner($db, $restaurantID);
}else {
	die(header('location: /'));
}

if (!$isOwner) 
	die(header('location: /'));