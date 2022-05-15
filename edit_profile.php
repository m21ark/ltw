<?php
require_once(__DIR__ . "/templates/common.tpt.php");
require_once(__DIR__ . "/database/connection.php");

// TODO should be the rest owner!!!
session_start();
if ($_SESSION['user'] == null) die(header('Location: /'));

$user = unserialize($_SESSION['user']);

output_header();
drawEditProfile($user);
output_footer();
