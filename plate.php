<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");


if (!isset($_GET['id'])) {
    die(header('Location: /'));
}

$db = getDatabaseConnection();

$dish = Dish::getDish($db, $_GET['id']);

if ($dish === null)
    die(header('Location: /'));

    
output_header();
drawPlateInfo($dish);
output_footer();
