<?php

namespace Wordprest;

use Wordprest\Controller\Router;
use Wordprest\Controller\Rewrite;
use Wordprest\Admin\Admin;

class Wordprest
{
    private $router;
    private $rewrite;

    public function __construct() {
        $this->router = new Router();
        $this->rewrite = new Rewrite();
        $this->admin = new Admin();
    }

    public function start()
    {
        $this->rewrite->start();
        $this->router->start();
    }
}
