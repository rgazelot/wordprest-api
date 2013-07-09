<?php

namespace Wordprest\Service;

use Wordprest\Service\Authenticator;

class Delete
{
    private $authenticator;

    public function __construct()
    {
        $this->authenticator = new Authenticator();
    }

    /**
     * Delete a post
     * @param  object $user
     * @param  string $id
     * @return random object (cd doc)
     */
    public function delete($user, $id)
    {
        if (empty($id)) {
            throw new \Exception('Missing ID parameter');
        }

        $this->authenticator->canDelete($user, $id);

        return wp_delete_post((int) $id);
    }
}
