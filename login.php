<?php
include_once("templates/common.tpt.php");
include_once("templates/login.tpt.php");
require_once("database/connection.php");



output_header();
drawLogin();
output_footer();
