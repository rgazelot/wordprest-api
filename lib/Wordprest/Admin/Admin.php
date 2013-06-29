<?php

namespace Wordprest\Admin;

class Admin
{
    public function __construct() {
        add_action('admin_menu', array(&$this, 'registerMenu'));
        add_action('admin_head', array(&$this, 'loading_fancybox'));
    }

    public function registerMenu()
    {
        // add_submenu_page( 'edit.php?post_type=le-projet', $term->name, $term->name, 'manage_options', $term->slug, array(&$this, 'redirect'));
        add_menu_page( 'WordpREST API', 'WordpREST API', 'manage_options', 'wordprest-api', array(&$this, 'displayPage'));
    }

    public function displayPage()
    {
        echo '<h1>WordpREST API</h1>';
    }
}
