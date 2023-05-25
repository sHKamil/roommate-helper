<?php

class Router
{

    private $routes = [];

    public function add($uri, $controller, $request_method)
    {
        $this->routes [] = [
            'uri' => $uri,
            'controller' => $controller,
            'request_method' => $request_method
        ];
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }
    
    private function abort($code = 404)
    {
        http_response_code($code);
        return view("error.php");
    }
    
    public function route($uri, $request_method)
    {
        foreach ($this->routes as $route)
        {
            if($route['uri'] === $uri && $route['request_method'] === strtoupper($request_method))
            {
                // die($route['controller']);
                return require base_path($route['controller']);
                // return call_user_func([
                //             'Core', $class_method
                //         ]);
            }
        }
        $this->abort();
    }
}
