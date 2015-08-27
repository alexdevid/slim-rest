<?php

class Kernel {

    /**
     * @var \Slim\Slim
     */
    public $app;

    /**
     * @var \Predis\Client
     */
    public $db;

    /**
     * @var array
     */
    public $config;

    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * @return $this
     */
    public function run() {
        $this->config = require_once __DIR__ . '/Config/config.php';
        $this->app = new \Slim\Slim();
        $this->auth = new Authenticator($this->config['security']);
        $this->instantiateRoutes()->app->run();
        return $this;
    }

    /**
     * @return $this
     */
    private function instantiateRoutes() {
        foreach ($this->config['routes'] as $controllerName => $routes) {
            foreach ($routes as $routeParams) {
                $route = new Route($controllerName, $routeParams);
                $method = $route->method;
                $this->app->$method($route->path, function () use ($route) {
                    $this->checkAuth($route);
                    $arguments = func_get_args();
                    call_user_func_array([
                        $route->controller,
                        $route->action
                    ], $arguments);

                });
            }
        }
        return $this;
    }

    /**
     * @param Route $route
     */
    private function checkAuth(Route $route) {
        if ($route->isSecure()) {
            $this->auth->authorize();
        }
    }

    /**
     * @return Kernel
     */
    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Kernel();
        }
        return $inst;
    }

    private function __construct() {

    }
}