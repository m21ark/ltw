<?php
include_once("templates/common.tpt.php");
include_once("templates/plates_carrossel.tpt.php");
include_once("templates/restaurants_carrossel.tpt.php");
include_once("templates/search.tpt.php");


output_header();
drawSearchScreen();
drawRestaurantsCarrossel(array());
drawPlatesCarrossel(array());
output_footer();
