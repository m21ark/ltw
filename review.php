<?php
include_once("templates/common.tpt.php");

require_once("database/connection.php");
require_once("database/restaurant.class.php");

output_header();
drawMakeReview();
output_footer();
