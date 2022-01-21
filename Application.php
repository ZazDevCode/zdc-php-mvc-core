<?php

/*** User: Zaz */

namespace app\core;

use app\core\Request;
use app\core\Session;
use app\core\db\Database;
use app\core\Response;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core
 */

class Application{
   
    public static $ROOT_DIR;
    
    public $layout = 'main';
    public $userClass;
    public $router;
    public $request;
    public $response;
    public $session;
    public $db;
    public static $app;
    public $controller = null;
    public $user;
    public $view;

    public function __construct($rootPath, array $config){
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = (new $this->userClass)->primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user = null;
        }
    }

    public static function isGuest(){
        return !self::$app->user;
    }
    
    public function run(){
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController(): \app\core\Controller{
        return $this->controller;
    }

    public function login($user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }
    
    public function setController(\app\core\Controller $controller): void{
        $this->controller = $controller;
    }
}