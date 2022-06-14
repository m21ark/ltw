<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/connection.php");

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

$db = getDatabaseConnection();

$stmt = $db->prepare("UPDATE OrderLocation SET lat = ? , lon = ? WHERE OrderID = ?");
$stmt->execute(array(htmlentities($_POST['lat']), htmlentities($_POST['lng']), htmlentities($_POST['OrderID'])));
