<?php

declare(strict_types=1);

require_once(__DIR__ . "/../database/Users/user_composite.class.php");
require_once(__DIR__ . "/../database/connection.php");

$db = getDatabaseConnection();

$stmt = $db->prepare("INSERT INTO Response
    VALUES (?,  ?)
");
 
$stmt->execute(array($_POST['id'], $_POST['comment']));

header("Location: ". $_REQUEST['HTTP_REFERER']);
die();