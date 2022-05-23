<?php 
declare(strict_types = 1);

require_once(__DIR__ . "/../database/connection.php");
require_once(__DIR__ . "/order.class.php");

class Notification
{   
    static function userHasNotification(int $id) : ?string{

        $db = getDatabaseConnection();
        $stmt = $db->prepare('
            SELECT *
            FROM "Notification"
            WHERE UserID = ?
        ');

        $stmt->execute(array($id));
        
        $notf = $stmt->fetch();

        // TODO: THIS SHOULD NOT BE A COMMENT ::: only used for testing porpuses 

        //$stmt = $db->prepare('
        //    DELETE 
        //    FROM "Notification"
        //    WHERE rowid = ?
        //');
//
        //$stmt->execute($notf['rowid']);

        
        return OrderStatus::status[$notf['OrderStateID']];
    }
}

