<?php

declare(strict_types=1);

include_once("user.abstract.php");
include_once("customer.class.php");
include_once("concrete_user_factory.class.php");

class UserComposite extends User
{

    public array $permissions = [];

    public function __construct()
    {
        // TODO::: TO PRESERVE SOLID PRINCIPLES WE SHOULD INJECT THE USER FACTORY
    }

    public function addPermission(?User $user): void
    {
        array_push($permissions, $user);
    }

    public static function login(PDO $db, string $email, string $password): ?User
    {
        return ConcreteUserFactory::getUserAccordingToType($db, $email, $password);
    }

    public function hasPermission(string $type): ?User
    {
        if (empty($permissions))
            return null;
        foreach ($permissions as $permission) {
            if (gettype($permission) === $type) {
                return $permission;
            }
        }

        return null;
    }
}
