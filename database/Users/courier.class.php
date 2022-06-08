<?php

declare(strict_types=1);


require_once(__DIR__ . "/user.abstract.php");


class Courier extends User
{
    public static function login(PDO $db, string $email, string $password): ?User
    {

        $stmt = $db->prepare('SELECT * FROM User WHERE lower(email) = ?');
        $stmt->execute(array($email));

        $user = $stmt->fetch();

        if (!($user && password_verify($password, $user['password'])))
            return null;


        // ------------------------------------------------------------------

        $stmt = $db->prepare('
            SELECT UserID, username, Address, phoneNumber, email
            FROM Courier LEFT JOIN USER on (CourierID = UserID)
            WHERE lower(email) = ?
        ');

        $stmt->execute(array(strtolower($email)));


        if ($customer = $stmt->fetch()) {
            return new Courier(
                (int)$customer['UserId'],
                $customer['username'],
                $customer['Address'],
                $customer['phoneNumber'],
                $customer['email']
            );
        } else return null;
    }

    public static function isCourier(PDO $db, string $email): bool
    {

        $stmt = $db->prepare('
            SELECT  UserID
            FROM Courier LEFT JOIN USER on (CourierID = UserID)
            WHERE lower(email) = ? 
      ');

        $stmt->execute(array(strtolower($email)));

        if ($courier = $stmt->fetch()) {
            if (empty($courier)) {
                return false;
            }
            return true;
        } else return false;
    }

    public static function getAssignedOrder(PDO $db): array
    {
        return [];
    }
}
