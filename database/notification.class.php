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

        if ($notf === false)
            return null;

        $stmt = $db->prepare('
            DELETE 
            FROM "Notification"
            WHERE id = ?
        ');

        $stmt->execute(array((int)$notf['id']));

        
        return OrderStatus::status[$notf['OrderStateID']];
    }
}

