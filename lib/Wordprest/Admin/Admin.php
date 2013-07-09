<?php

namespace Wordprest\Admin;

class Admin
{
    public function __construct() {
        add_action('admin_menu', array(&$this, 'registerMenu'));
        add_action('admin_post_generate_key', array(&$this, 'generateKey'));
        add_action('admin_post_delete_key', array(&$this, 'deleteKey'));
    }

    /**
     * Hook to register the menu
     */
    public function registerMenu()
    {
        add_menu_page('WordpREST API', 'WordpREST API', 'manage_options', 'wordprest-api', array(&$this, 'displayIndex'));
        add_submenu_page( 'wordprest-api', 'Security', 'Security', 'manage_options', 'security', array(&$this, 'displaySecurity'));
    }

    /**
     * Hook to display the index page
     */
    public function displayIndex()
    {
        echo file_get_contents(__DIR__ . '/Page/index.html');
    }

    /**
     * Hook to display the security page
     */
    public function displaySecurity()
    {
        include(__DIR__ . '/Page/security.php');
    }

    /**
     * Hook called when we submit the 'generate a key' form
     */
    public function generateKey()
    {
        $key = $this->getRandomKey();
        $apiKeys = get_option('wordprest_api_keys');
        $apiKeys[$_POST['wordprest_user_ID']] = $key;
        update_option('wordprest_api_keys', $apiKeys);
        wp_redirect(admin_url('admin.php?page=security'));
    }

    /**
     * Hook called when we submit the 'delete key' form
     */
    public function deleteKey()
    {
        $apiKeys = get_option('wordprest_api_keys');
        unset($apiKeys[$_POST['wordprest_user_ID']]);
        update_option('wordprest_api_keys', $apiKeys);
        wp_redirect(admin_url('admin.php?page=security'));
    }

    /**
     * Generate a random api key
     * @return string $apiKey
     */
    private function getRandomKey()
    {
        return md5(uniqid(rand(), true));
    }
}
