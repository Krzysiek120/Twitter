<?php

namespace Cms;

class App
{
    private $db;
    private $config;
    private $user;
    private $tweet;
    
    public function __construct($di)
    {
        $this->db = $di['db'];
        $this->config = $di['config'];
        $this->checkUser();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function getConfig()
    {
        return $this->config;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getTweet()
    {
        return $this->tweet;
    }

    public function run($controller, $action)
    {
        $class = 'Cms\Controllers\\'.$controller.'Controller';
        $method = $action.'Action';
        $controller = new $class($this);
        $data = $controller->$method();

        extract($data);
        ob_start();
        include 'views/templates/'.$template.'.php';
        $content = ob_get_clean();
        include 'views/layout.php';
    }
    
    private function checkUser()
    {
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $stmt = $this->getDb()
                ->prepare('SELECT * FROM `Users` WHERE `id`=:id');
            $stmt->execute([
                ':id' => $userId,                
            ]);
            
            $this->user = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }
}
