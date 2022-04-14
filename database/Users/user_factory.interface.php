<?php

    declare(strict_types = 1);

    interface UserFactory {
        public function getUserAccordingToType(PDO $db, string $email, string $password);
    }

?>