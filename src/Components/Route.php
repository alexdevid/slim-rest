<?php
namespace Components;

class Route {

    const METHOD_DEFAULT = 'get';

    /**
     * @var boolean
     */
    public $secure;

    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $path;

    /**
     * @var string
     */
    public $action;

    /**
     * @var \Controllers\ControllerInterface
     */
    public $controller;

    /**
     * @var array
     */
    private $routeParams;

    /**
     * @param string $controllerName
     * @param array $routeParams
     */
    public function __construct($controllerName, array $routeParams) {
        $this->routeParams = $routeParams;

        $this->path = $routeParams[0];
        $this->setMethod()->setSecure();
        $this->action = $this->method . $this->getActionName();
        $this->controller = $this->getController($controllerName);
    }

    /**
     * @return bool
     */
    public function isSecure() {
        return $this->secure;
    }

    /**
     * @return $this
     */
    private function setMethod() {
        if (isset($this->routeParams[1])) {
            $this->method = $this->routeParams[1];
            return $this;
        }
        $this->method = self::METHOD_DEFAULT;
        return $this;
    }

    /**
     * @return $this
     */
    private function setSecure() {
        $this->secure = isset($this->routeParams[2]) ? $this->routeParams[2] : false;
        return $this;
    }

    /**
     * @param string $controllerName
     * @return \Controllers\ControllerInterface
     * @throws \Exception
     */
    public function getController($controllerName) {
        $controllerName = '\\Controllers\\' . ucfirst($controllerName) . 'Controller';
        if (class_exists($controllerName)) {
            return new $controllerName;
        }
        throw new \Exception('Controller ' . $controllerName . ' not found', 500);
    }

    /**
     * @return string
     */
    private function getActionName() {
        $path = trim($this->path, '/');
        $pathArray = explode('/', $path);
        return ucfirst($pathArray[0]);
    }
}