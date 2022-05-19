<?php
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()){
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

// TODO should be the rest owner!!!
$user = $session->getUser();

output_header();
drawEditProfile($user);
output_footer();