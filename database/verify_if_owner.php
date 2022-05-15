<?php

$isOwner = false;
$owner = isset($user)? $user->hasPermission("RestaurantOwner") : null;
if ($owner !== null){
    $isOwner = $owner->isTheOwner($db, $restaurantID);
}else {
	die(header('location: /'));
}

if (!$isOwner) 
	die(header('location: /'));