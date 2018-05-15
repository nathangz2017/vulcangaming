<?php

namespace App\Providers;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class UserProvider implements UserProviderInterface {
    public function __construct() { }

    public function loadUserByUsername($username) {
         return new User();
    }

    public function refreshUser(UserInterface $user) { }
    public function supportsClass($class) { }
}