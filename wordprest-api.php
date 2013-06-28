<?php
/*
Plugin Name: WordpREST API
Description: Turns your Wordpress blog into a RESTful API
Version: 1.0
Author: Gabriel Majoulet
Author URI: http://www.gabriel-majoulet.fr
*/

require_once('SplClassLoader.php');

$loader = new SplClassLoader('Wordprest', 'lib');
$loader->register();

use Wordprest\Wordprest;

$app = new Wordprest();
$app->start();