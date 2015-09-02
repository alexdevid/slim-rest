<?php

use Components\Route;
use OAuth2\GrantType\AuthorizationCode;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\Scope;
use OAuth2\Server;
use OAuth2\Storage\Memory;
use Symfony\Component\Yaml\Yaml;

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
     * @var array
     */
    public $routes;

    /**
     * @var Server
     */
    public $oauth;

    /**
     * @return $this
     */
    public function run() {
        require_once __DIR__ . '/../config/propel/config.php';
        $this->config = Yaml::parse(file_get_contents(__DIR__ . '/../config/config.yml'));
        $this->routes = Yaml::parse(file_get_contents(__DIR__ . '/../config/routes.yml'));
        $this->app = new \Slim\Slim();
        $this->app->config([
            'templates.path' => __DIR__ . '/Views/'
        ]);
        $this->oauth = $this->configureOAuth();
        $this->instantiateRoutes()->app->run();
        return $this;
    }

    /**
     * @return array
     */
    public function getRequestBody() {
        $json = $this->app->request()->getBody();
        return json_decode($json, true);
    }

    /**
     * @return $this
     */
    private function instantiateRoutes() {
        foreach ($this->routes as $path => $routeParams) {
            $route = new Route($controllerName, $routeParams);
            $method = $route->method;

            $this->app->$method($route->path, function () use ($route) {
                if (!$route->controller->isPublic) {
                    $this->checkAuth($route);
                }
                $arguments = func_get_args();
                call_user_func_array([
                    $route->controller,
                    $route->action
                ], $arguments);

            });
        }
        return $this;
    }

    /**
     * @param Route $route
     * @throws \Slim\Exception\Stop
     */
    private function checkAuth(Route $route) {
        $request = OAuth2\Request::createFromGlobals();

        $scopeRequired = [];

        if ($route->isSecure()) {
            $scopeRequired = 'admin';
        }
        if (!$this->oauth->verifyResourceRequest($request, NULL, $scopeRequired)) {
            $response = $this->oauth->getResponse();
            $this->app->response()->status($response->getStatusCode());
            $response->send();
            $this->app->stop();
        }
    }

    /**
     * @return Server
     */
    private function configureOAuth() {

        $storage = new \Components\PropelStorage();
        $server = new Server($storage);

        $server->addGrantType(new ClientCredentials($storage));
        $server->addGrantType(new AuthorizationCode($storage));

        $memory = new Memory(array(
            'default_scope' => [],
            'supported_scopes' => ['admin']
        ));
        $scopeUtil = new Scope($memory);
        $server->setScopeUtil($scopeUtil);
        return $server;
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