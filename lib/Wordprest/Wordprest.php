<?php

namespace Wordprest;

use Wordprest\Controller\Router;
use Wordprest\Controller\Rewrite;

class Wordprest
{
    private $router;
    private $rewrite;

    public function __construct() {
        $this->router = new Router();
        $this->rewrite = new Rewrite();
    }

    public function start()
    {
        $this->rewrite->start();
        $this->router->start();
    }
}
