<?php

declare(strict_types = 1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /')); 


include_once("templates/common.tpt.php");

require_once("database/connection.php");
require_once(__DIR__ . "/database/Users/user_composite.class.php");

// maybe later we can set cokkies that determine the above res/dishes

$user = unserialize($_SESSION['user']);

$customer = $user->hasPermission('Customer');
if($customer == null) die(header('Location: /')); 

$cart = $customer->cart;

$db = getDatabaseConnection();

output_header();
drawCartList($db , $cart);
output_footer();

