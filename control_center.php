<?php
include_once("templates/common.tpt.php");
require_once(__DIR__ . "/templates/kanban_board.tpt.php");
require_once("database/connection.php");

session_start();

if (!isset($_GET['id'])) {
    die(header('Location: /'));
}

if (!isset($_SESSION['user']))
    die(header('Location: /'));

$user = unserialize($_SESSION['user']);

$uid = $user->permissions[0]->id; 
$restaurantID = $_GET['id'];
$db = getDatabaseConnection();

// -----------------------------------------------------------

require_once(__DIR__ . "/database/verify_if_owner.php");

// -----------------------------------------------------------

output_header();
drawKanbanBoard();
output_footer();
