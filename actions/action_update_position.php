<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");


$db = getDatabaseConnection();

$stmt = $db->prepare("UPDATE OrderLocation SET lat = ? , lon = ? WHERE OrderID = ?");
$stmt->execute(array(htmlentities($_POST['lat']), htmlentities($_POST['lng']), htmlentities($_POST['OrderID'])));
