<?php

namespace Cms\Controllers;

use Cms\App;

class AbstractController
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getConfig()
    {
        return $this->app->getConfig();
    }
    
    public function getDb()
    {
        return $this->app->getDb();
    }
    
    public function getUser()
    {
        return $this->app->getUser();
    }
    
    public function getTweet()
    {
        return $this->app->getTweet();
    }
}
