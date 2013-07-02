<?php

namespace Wordprest\Controller;

use Wordprest\Service\Payload;
use Wordprest\Service\Select;

class Router
{
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
                $query->set('post_type', htmlspecialchars($query->query_vars['wordprest_post_type']));
                break;
            case 'PUT':
            case 'PATCH':
                break;
            case 'DELETE':
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

        $payload = new Payload();

        if (0 === count($wp_query->posts)) {
            $payload->error(array(), 404, 'No posts found');
            return;
        }

        $query = new Select();
        $posts = $query->format($wp_query->posts);
        $payload->success($posts);
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
