<?php

namespace Wordprest\Service;

class Authenticator
{
    /**
     * Authenticate the user with his api key
     * @return object $user
     */
    public function authenticate()
    {
        if (!isset($_GET['api_key'])) {
            throw new \Exception('Parameter api_key not found');
        }

        $apiKey = $_GET['api_key'];
        $option = array_flip(get_option('wordprest_api_keys'));

        if (!array_key_exists($apiKey, $option)) {
            throw new \Exception('Wrong api_key');
        }

        return wp_set_current_user($option[$apiKey]);
    }

    /**
     * Is the user allowed to save ?
     * @param  object $user
     * @param  array $options
     * @return boolean
     */
    public function canCreate($user)
    {
        if (!current_user_can('create_posts'))
            throw new \Exception('You\'re not allowed to create a post');
    }

    /**
     * Is the user allowed to edit ?
     * @param  object $user
     * @param  string $id
     * @return boolean
     */
    public function canEdit($user, $id)
    {
        if (!current_user_can('edit_post', (int) $id))
            throw new \Exception('You\'re not allowed to edit this post');
    }

    /**
     * Is the user allowed to delete ?
     * @param  object $user
     * @param  string $id
     * @return boolean
     */
    public function canDelete($user, $id)
    {
        if (!current_user_can('delete_post', (int) $id))
            throw new \Exception('You\'re not allowed to delete this post');
    }

    /**
     * Is the user allowed to comment ?
     * @param  object $user
     * @param  string $id
     * @return boolean
     */
    public function canComment($user, $id)
    {}
}
