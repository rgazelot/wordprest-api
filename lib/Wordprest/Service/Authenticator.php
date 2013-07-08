<?php

namespace Wordprest\Service;

class Authenticator
{
    public function authenticate()
    {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            return false;
        }

        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            return false;
        }

        wp_set_current_user($user->ID);

        return $user;
    }
}
