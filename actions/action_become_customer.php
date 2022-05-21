<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/../database/Users/customer.class.php");

$db = getDatabaseConnection();

Customer::addCostumerById($db, (int)$_POST['id']);
