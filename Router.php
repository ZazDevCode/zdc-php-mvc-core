<?php
namespace app\core;

use app\core\exception\NotFoundException;

class Router{

    public $request;
    public $response;
    protected $routes = [];

    public function __construct($request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback){
        $this->routes['get'][$path] = $callback;     
    }

    public function post($path, $callback){
        $this->routes['post'][$path] = $callback; 
    }

    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false){
            throw new NotFoundException();
        }
        if(is_string($callback)){
            return Application::$app->view->renderView($callback);
        }
        if(is_array($callback)){
            /** @var \app\core\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }  
        }
        return call_user_func($callback, $this->request, $this->response);
    }
}
