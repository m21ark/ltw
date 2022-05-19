<?php

declare(strict_types=1);

include_once(__DIR__ . "/../templates/common.tpt.php");
include_once(__DIR__ . "/../templates/login.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}


output_header();
drawUserInfoPage($session->getUser());
output_footer();