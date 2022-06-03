<?php
require_once(__DIR__ . "/notification_types.php");

if(rand(1,3) == 1){
    /* Fake an error */
    header("HTTP/1.0 404 Not Found");
    die();
}

/*
    THIS php file must be able to receive by post an id of a user and check if he has a notification, 
    sending an array of the notifications, as described on the notifications type .php  
*/

echo(json_encode($notifications));
