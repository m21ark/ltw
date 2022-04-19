<?php
    declare(strict_types = 1);

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

    public function name() {
        return $this->username;
    }
    
    public static abstract function login(PDO $db, string $email, string $password) : ?User;


    }
?>