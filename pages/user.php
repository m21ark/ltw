<?php

declare(strict_types=1);

include_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/forms.tpt.php");
include_once(__DIR__ . "/../templates/login.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

// Restricts access to logged in users
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if (!$session->isLoggedIn()) {
    $session->addMessage('erro', 'Login required. Redirected to main page');
    die(header('Location: /'));
}

// TODO URGENTE :: COMO É QUE ALGUEM ADQUERE PRIVILEGIOS ? 
// POR EX COMO É QUE ALGUEM PASSA A OWNER OU VIRA COURIER

output_header();
drawUserInfoPage($session->getUser());
output_footer();
