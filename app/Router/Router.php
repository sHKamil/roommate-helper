<?php

namespace app\Router;

use app\Middleware\Middleware;

class Router
{

    private $routes = [];

    public function add($uri, $class, $class_method, $method)
    {
        $this->routes [] = [
            'uri' => $uri,
            'class' => $class,
            'class_method' => $class_method,
            'method' => $method,
            'middleware' => NULL
        ];
        return $this;
    }

    public function get($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'GET');
    }

    public function post($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'POST');
    }

    public function delete($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'DELETE');
    }

    public function patch($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'PATCH');
    }

    public function put($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'PUT');
    }

    public function logout($uri, $class, $class_method)
    {
        return $this->add($uri, $class, $class_method, 'LOGOUT');
    }
    
    private function abort($code = 404)
    {
        http_response_code($code);
        return view("error");
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }
    
    public function route($uri, $method)
    {
        foreach ($this->routes as $route)
        {
            if($route['uri'] === $uri && $route['method'] === strtoupper($method))
            {
                Middleware::resolve($route['middleware']);
                $class = new $route['class']();
                return call_user_func([$class, $route['class_method']]);
            }
        }
        $this->abort();
    }
}
