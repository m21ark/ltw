<?php
include_once("templates/common.tpt.php");
require_once(__DIR__ . "/templates/kanban_board.tpt.php");
require_once("database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) die(header('Location: /'));

if (!isset($_GET['id']))
    die(header('Location: /'));


$user = unserialize($session->getUserSerialized());

$uid = $user->permissions[0]->id;
$restaurantID = $_GET['id'];
$db = getDatabaseConnection();

// -----------------------------------------------------------

require_once(__DIR__ . "/database/verify_if_owner.php");

// -----------------------------------------------------------

output_header();
drawKanbanBoard($db, $restaurantID);
output_footer();
