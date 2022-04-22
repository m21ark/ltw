<?php

declare(strict_types=1);

include_once("user_factory.interface.php");
include_once("costumer.class.php");
include_once("restaurant_owner.class.php");

class ConcreteUserFactory implements UserFactory
{
    public static function getUserAccordingToType(PDO $db, string $email, string $password): ?User
    {
        $user = new UserComposite();
        if (RestaurantOwner::isOwnerOfRestaurant($db, $email)) {
            $user->addPermission(RestaurantOwner::login($db, $email, $password));
        }
        if (Customer::isCustomer($db, $email)) {
            $user->addPermission(Customer::login($db, $email, $password));
        }

        if (empty($user->permissions))
            return null;

        return $user;
    }
}
