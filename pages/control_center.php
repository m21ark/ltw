<?php
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/kanban_board.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');

$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}


if (!isset($_GET['id']) && !isset($_GET['cid']))
    die(header('Location: /'));


$user = unserialize($session->getUserSerialized());

$uid = $user->permissions[0]->id;
$restaurantID = $_GET['id'];
$db = getDatabaseConnection();


$courier = isset($_SESSION['user']) ? $user->hasPermission("Courier") : null;
if ($courier !== null) {
    output_header();
    drawKanbanBoardCourier($db,  $_GET['cid']);
    output_footer();
    die();
}


require_once(__DIR__ . "/../database/verify_if_owner.php");


output_header();
drawKanbanBoardOwner($db, $restaurantID);
output_footer();
