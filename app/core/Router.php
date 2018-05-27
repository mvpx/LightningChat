<?php

class Router {
    
    protected $controller = 'Pages';
    protected $method = 'index';
    protected $routes = [];

    public function __construct() {
        $url = $this->getUrl();

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/LightningChat/app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/LightningChat/app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->routes = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->routes);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
        }
    }
}