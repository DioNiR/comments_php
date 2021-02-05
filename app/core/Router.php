<?php

namespace app\core;

use Exception;

class Router
{
    /**
     * @var Registry Registry
     */
    private Registry $registry;
    private $path;
    private $args = [];

    /**
     * Router constructor.
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param $path
     * @throws Exception
     */
    public function addPath($path)
    {
        $path = trim($path, '/\\');
        $path .= DIRECTORY_SEPARATOR;

        if (is_dir($path) == false) {
            throw new Exception ('Invalid controller path: `' . $path . '`');
        }

        $this->path = $path;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function run()
    {
        // Анализируем путь
        try {
            /** @var Controller $controller */
            $controller = $this->getController();
        } catch (Exception $e) {
            throw new Exception('404 Not Found');
        }

        $class = $controller->controller;
        $controllerClass = new $class($this->registry);

        if (is_callable(array($controllerClass, $controller->action)) == false) {
            die ('404 Not Found');
        }

        return $controllerClass->{$controller->action}();
    }

    /**
     * @return Controller
     * @throws Exception
     */
    private function getController(): Controller
    {
        $controller = new Controller();

        $route = (empty($_GET['route'])) ? '' : $_GET['route'];
        if (empty($route)) {
            $route = 'index';
        }

        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        $controllerName = array_shift($parts);
        $className = $this->getControllerName($controllerName);
        if (class_exists($className)) {
            $controller->controller = $className;
        } else {
            throw new Exception('Controller Not Found');
        }

        if (empty($controller->controller)) {
            $controller->controller = $this->getControllerName('index');
        };

        $controller->action = $this->getActionName(array_shift($parts));
        if (empty($controller->action)) {
            $controller->action = $this->getActionName('index');
        }

        $controller->args = $parts;

        return $controller;
    }

    /**
     * @param $controllerName
     * @return string
     */
    private function getControllerName($controllerName)
    {
        return sprintf('\app\controllers\%sController' , ucfirst($controllerName));
    }

    /**
     * @param $actionName
     * @return mixed
     */
    private function getActionName($actionName)
    {
        return $actionName;
    }
}