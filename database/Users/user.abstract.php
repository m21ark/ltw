<?php

declare(strict_types=1);

abstract class User
{
    public int $id;
    public string $username;
    public string $address;
    public string $phone;
    public string $email;

    public function __construct(int $id, string $username, string $address, string $phone, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function name()
    {
        return $this->username;
    }

    public static abstract function login(PDO $db, string $email, string $password): ?User;

    public static function userExists(PDO $db, string $email): bool
    {
        $stmt = $db->prepare('
            SELECT UserId
            FROM USER 
            WHERE lower(email) = ? 
      ');

        $stmt->execute(array(strtolower($email)));

        if ($owner = $stmt->fetch()) {
            if (empty($owner)) {
                return false;
            }
            return true;
        } else return false;
    }

    public static function saveUser(PDO $db, string $username, $password, string $address, string $phone, string $email)
    {

        $stmt = $db->prepare('INSERT INTO "User" VALUES (NULL, ? , ? , ? , ? , ? , NULL )');


        // Password Salt Treatment & Hashing
        $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);


        $stmt->execute(array(strtolower($email), $username, $password, $address, $phone));
    }
}
