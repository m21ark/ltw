<?php

declare(strict_types=1);

require_once(__DIR__ . "/user_factory.interface.php");
require_once(__DIR__ . "/customer.class.php");
require_once(__DIR__ . "/restaurant_owner.class.php");
require_once(__DIR__ . '/user_factory.interface.php');
require_once(__DIR__ . '/user_composite.class.php');
require_once(__DIR__ . "/courier.class.php");

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
        //if (Courier::isCourier($db, $email)) {
        //    $user->addPermission(Courier::login($db, $email, $password));
        //}

        if (empty($user->permissions))
            return null;

        return $user;
    }
}
