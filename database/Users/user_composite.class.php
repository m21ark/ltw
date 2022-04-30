<?php

declare(strict_types=1);

require_once("user.abstract.php");
require_once("customer.class.php");
require_once("concrete_user_factory.class.php");

class UserComposite extends User
{

    public array $permissions = [];

    public function __construct()
    {
        // TODO::: TO PRESERVE SOLID PRINCIPLES WE SHOULD INJECT THE USER FACTORY
    }

    public function addPermission(?User $user): void
    {
        if ($user == null)
            return;
        array_push($this->permissions, $user);
    }

    public static function login(PDO $db, string $email, string $password): ?User
    {
        return ConcreteUserFactory::getUserAccordingToType($db, $email, $password);
    }

    public function hasPermission(string $type): ?User
    {
        foreach ($this->permissions as $permission) {
            if (get_class($permission) == $type) {
                return $permission;
            }
        }

        return null;
    }
}
