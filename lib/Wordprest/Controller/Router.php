<?php

namespace Wordprest\Controller;

use Wordprest\Service\Payload;
use Wordprest\Service\Select;
use Wordprest\Service\Insert;
use Wordprest\Service\Delete;
use Wordprest\Service\Authenticator;

class Router
{
    private $payload;
    private $select;
    private $insert;
    private $delete;
    private $authenticator;

    public function __construct()
    {
        $this->payload = new Payload();
        $this->select = new Select();
        $this->insert = new Insert();
        $this->delete = new Delete();
        $this->authenticator = new Authenticator();
    }

    /**
     * Starts the router
     * @return
     */
    public function start()
    {
        add_action('parse_query', array(&$this, 'parse'));
        add_action('wp', array(&$this, 'send'));
    }

    /**
     * Parse the query
     * @param  object $query
     * @return
     */
    public function parse($query)
    {
        if (!isset($query->query_vars['wordprest_api'])) {
            return;
        }

        // Prevent from wiping options GET parameters
        $query = $this->setOptions($query, $_GET);

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                try {
                    $user = $this->authenticator->authenticate();
                    $this->insert->save($_POST['data'], $user, $query->query_vars['wordprest_post_type'], $query->query_vars['wordprest_id']);
                } catch (\Exception $e) {
                    $this->payload->error(array(), 400, $e->getMessage());
                }
                break;
            case 'DELETE':
                try {
                    $user = $this->authenticator->authenticate();
                    $deletedPost = $this->delete->delete($user, $query->query_vars['wordprest_id']);
                    $this->payload->success(array($deletedPost));
                } catch (\Exception $e) {
                    $this->payload->error(array(), 400, $e->getMessage());
                }
                break;
            case 'GET':
            default:
                $query->set('post_type', htmlspecialchars($query->query_vars['wordprest_post_type']));
                if (isset($query->query_vars['wordprest_id'])) {
                    $query->set('p', htmlspecialchars($query->query_vars['wordprest_id']));
                }
                break;
        }
    }

    /**
     * Send the data
     * @param  $wp
     * @return
     */
    public function send($wp)
    {
        global $wp_query;

        if (!isset($wp_query->query_vars['wordprest_api'])) {
            return;
        }

        if (0 === count($wp_query->posts)) {
            $this->payload->error(array(), 404, 'No posts found');
            return;
        }

        $posts = $this->select->format($wp_query->posts);
        $this->payload->success($posts);
    }

    /**
     * Set GET options
     * @param object $query
     * @param array $options
     * @return object $query
     */
    private function setOptions($query, $options)
    {
        foreach ($options as $option => $value) {
            $query->set($option, $value);
        }

        return $query;
    }
}
