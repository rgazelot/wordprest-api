<?php

namespace Wordprest\Controller;

class Rewrite
{
    /**
     * Start the rewrite rules
     * @return
     */
    public function start()
    {
        add_action('generate_rewrite_rules', array(&$this, 'generate'));
        add_filter('query_vars', array(&$this, 'addQueryVars'));
        $this->flush();
        $this->register();
    }

    /**
     * Generating new URLs to catch them
     * @return
     */
    public function generate()
    {
        global $wp_rewrite;

        $rules = array(
            'api/(.+)?$' => 'index.php?fuckin-works=true'
        );

        $wp_rewrite->rules = $rules + $wp_rewrite->rules;
    }

    /**
     * Add query vars to wordpress
     * @param array $wpvar
     */
    public function addQueryVars($wpvar)
    {
        $newVars = array(
            'fuckin-works'
        );

        return array_merge($wpvar, $newVars);
    }

    /**
     * Flush the rewrite rules
     * @return
     */
    public function flush()
    {
        global $wp_rewrite;
        // $wp_rewrite->flush_rules();
    }

    /**
     * Flushing the rules when needed
     * @return
     */
    private function register()
    {}
}
