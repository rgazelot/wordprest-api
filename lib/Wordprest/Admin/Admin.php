<?php

namespace Wordprest\Admin;

class Admin
{
    public function __construct() {
        add_action('admin_menu', array(&$this, 'registerMenu'));
        add_action('admin_post_generate_key', array(&$this, 'generateKey'));
        add_action('admin_post_delete_key', array(&$this, 'deleteKey'));
    }

    public function registerMenu()
    {
        add_menu_page('WordpREST API', 'WordpREST API', 'manage_options', 'wordprest-api', array(&$this, 'displayIndex'));
        add_submenu_page( 'wordprest-api', 'Security', 'Security', 'manage_options', 'security', array(&$this, 'displaySecurity'));
    }

    public function displayIndex()
    {
        echo file_get_contents(__DIR__ . '/Page/index.html');
    }

    public function displaySecurity()
    {
        include(__DIR__ . '/Page/security.php');
    }

    public function generateKey()
    {
        $key = uniqid();
        $apiKeys = get_option('wordprest_api_keys');
        $apiKeys[$_POST['wordprest_user_ID']] = $key;
        update_option('wordprest_api_keys', $apiKeys);
        wp_redirect(admin_url('admin.php?page=security'));
    }

    public function deleteKey()
    {
        $apiKeys = get_option('wordprest_api_keys');
        unset($apiKeys[$_POST['wordprest_user_ID']]);
        update_option('wordprest_api_keys', $apiKeys);
        wp_redirect(admin_url('admin.php?page=security'));
    }
}
