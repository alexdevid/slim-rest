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
     * @param array $routeParams
     */
    public function __construct(array $routeParams) {
        $this->routeParams = $routeParams;
        $this->path = $routeParams[0];
        $this->setMethod()->setSecure();
        $this->action = $this->getActionName();
        $this->controller = $this->getController();
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
        if (isset($this->routeParams[2])) {
            $this->method = $this->routeParams[2];
            return $this;
        }
        $this->method = self::METHOD_DEFAULT;
        return $this;
    }

    /**
     * @return $this
     */
    private function setSecure() {
        $this->secure = isset($this->routeParams[3]) ? $this->routeParams[3] : false;
        return $this;
    }

    /**
     * @return \Controllers\ControllerInterface
     * @throws \Exception
     */
    public function getController() {
        $routeArray = explode('/', $this->routeParams[1]);
        $controllerName = '\\Controllers\\' . ucfirst($routeArray[0]) . 'Controller';
        if (class_exists($controllerName)) {
            return new $controllerName;
        }
        throw new \Exception('Controller ' . $controllerName . ' not found', 500);
    }

    /**
     * @return string
     */
    private function getActionName() {
        $routeArray = explode('/', $this->routeParams[1]);
        return trim($routeArray[1], '/');
    }
}