<?php
require_once(__DIR__ . "/../templates/common.tpt.php");
require_once(__DIR__ . "/../templates/forms.tpt.php");
require_once(__DIR__ . "/../templates/login.tpt.php");
require_once(__DIR__ . "/../database/connection.php");

output_header();
drawLogin();
output_footer();
