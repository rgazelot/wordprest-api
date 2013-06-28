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
        if (isset($query->query_vars['fuckin-works'])) {
            die(var_dump('FUCKIN WORKS'));
        }
    }
}
