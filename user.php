<?php

declare(strict_types=1);

// Restricts access to logged in users
require_once(__DIR__ . '/utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()){
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

include_once("templates/common.tpt.php");
include_once("templates/login.tpt.php");
require_once("database/connection.php");

output_header();
drawUserInfoPage($session->getUser());
output_footer();
