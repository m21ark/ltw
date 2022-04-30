<?php

declare(strict_types = 1);

session_start();

if ($_SESSION['user'] == null) die(header('Location: /')); // TODO: MENSSAGE ERROR OR SOMETHING 

include_once("templates/common.tpt.php");
include_once("templates/login.tpt.php");
require_once("database/connection.php");

$user = unserialize($_SESSION['user']);

output_header();
drawUserInfoPage($user);
output_footer();
