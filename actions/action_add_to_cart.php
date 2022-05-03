<?php

declare(strict_types=1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /'));

require_once(__DIR__ . "/../database/Users/user_composite.class.php");

$user = unserialize($_SESSION['user']);

$customer = $user->hasPermission('Customer');
if($customer == null) die(header('Location: /')); 

$customer->addToCart((int)$_POST['id']);

$_SESSION['user'] = serialize($user);

die(header('Location: ' . $_SERVER['HTTP_REFERER']));