<?php

namespace Wordprest\Controller;

class Router
{
    public function start()
    {
        add_action('parse_query', array(&$this, 'parse'));
    }

    public function parse($query)
    {
        if (isset($query->query_vars['api'])) {
            var_dump($query->query_vars['data_post_type']);
            var_dump($query->query_vars['data_id']);
            die();
        }
    }
}
