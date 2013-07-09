<?php

namespace Wordprest\Service;

use Wordprest\Service\Authenticator;

class Insert
{
    private $authenticator;

    public function __construct()
    {
        $this->authenticator = new Authenticator();
    }

    /**
     * Save a post. Works for creation, edition or patch
     * @param  array  $data
     * @param  object $user
     * @param  string $postType
     * @param  string $id
     * @return Redirect
     */
    public function save($data, $user, $postType, $id)
    {
        if (empty($data)) {
            throw new \Exception('"data" POST parameter is missing');
        }

        if (!empty($id)) { // An ID is passed, we're editing/patching some content
            $this->authenticator->canEdit($user, $id);
            $data['ID'] = (int) $id;
        } else { // No ID is passed, we're creating some content
            $this->authenticator->canCreate($user);
            unset($data['ID']);
            status_header(201);
        }

        $data['post_author'] = $user->ID;
        $data['post_type'] = $postType;

        $result = wp_insert_post($data, true);

        if (is_WP_Error($result)) {
            throw new \Exception('Missing mandatory parameters');
        }

        header('Location: ' . get_bloginfo('url') . '/api/' . $postType . '/' . $id);
        die;
    }
}
