<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");

output_header();
drawPlateInfo();
output_footer();
