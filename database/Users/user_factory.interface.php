<?php

declare(strict_types=1);

interface UserFactory
{
    public static function getUserAccordingToType(PDO $db, string $email, string $password);
}
