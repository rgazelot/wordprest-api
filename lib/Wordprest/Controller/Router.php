<?php

namespace Wordprest\Controller;

use Wordprest\Service\Payload;

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
        if (!isset($query->query_vars['api'])) {
            return;
        }

        // Prevent from wiping options GET parameters
        $query = $this->setOptions($query, $_GET);

        $query->set('post_type', htmlspecialchars($query->query_vars['data_post_type']));
        if (isset($query->query_vars['data_id'])) {
            $query->set('p', htmlspecialchars($query->query_vars['data_id']));
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
        $payload = new Payload();
        if (0 === count($wp_query->posts)) {
            $payload->error([], 404, 'No posts found');
            return;
        }

        $payload->success($wp_query->posts);
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
