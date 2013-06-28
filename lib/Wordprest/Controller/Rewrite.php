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
        // $this->flush();
        // $this->register();
    }

    /**
     * Generating new URLs to catch them
     * @return
     */
    public function generate()
    {
        global $wp_rewrite;

        $rules = array(
            'api/([a-zA-Z_-]+)/([0-9]+)$' => 'index.php?api&data_post_type=' . $wp_rewrite->preg_index(1) . '&data_id=' . $wp_rewrite->preg_index(2),
            'api/([a-zA-Z_-]+)?$' => 'index.php?api&data_post_type=' . $wp_rewrite->preg_index(1)
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
            'api',
            'data_post_type',
            'data_id'
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
        $wp_rewrite->flush_rules();
    }

    /**
     * Flushing the rules when needed
     * @return
     */
    private function register()
    {}
}
