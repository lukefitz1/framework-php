<?php

class Core_Controller_Index {

    private $routes = array();
    private $defaultAction = 'index';
    private $mod;
    private $control;
    private $act;
    private $obj;

    public function __construct() {
        $this->getUrl();
    }

    function getUrl() {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $this->routes = array_pad($uri, 4, $this->defaultAction);

        echo '<br />Routes0: ' . $this->routes[0];
        echo '<br />Routes1: ' . $this->routes[1];
        echo '<br />Routes2: ' . $this->routes[2];
        echo '<br />Routes3: ' . $this->routes[3];

        if ($this->routes[1]) {

            for ($i = 2; $i <= 3; $i++) {
                if ($this->routes[$i] == '') {
                    $this->routes[$i] = $this->defaultAction;
                }
            }

            $this->mod = ucfirst($this->routes[1]);
            $this->control = ucfirst($this->routes[2]);
            $this->act = $this->routes[3];

            echo '<br /><br />Module: ' . $this->mod;
            echo '<br />Controller: ' . $this->control;
            echo '<br />Action: ' . $this->act . '<br />';

            $this->checkRoute();
        }
    }

    function checkRoute() {
        if ($this->moduleExists()) {
            $this->controllerExists();
            $this->actionExists();
        }
    }

    function moduleExists() {
        try {
            if (!file_exists(APP . $this->mod)) {
                throw new Exception('Module not found', 404);
            } else {
                return true;
            }
        } catch (Exception $e) {
            echo '<br />Caught exception: ' . $e->getMessage() . '<br />';
            echo 'Caught exception code: ' . $e->getCode() . '<br />';
        }
    }

    function controllerExists() {
        echo "<br />Controller: " . $this->mod . "/controller/{$this->mod}" . "_" . "Controller_" . ucfirst($this->control) . ".php";
        if (file_exists(APP . $this->mod . "/controller/{$this->mod}" . "_" . "Controller_" . ucfirst($this->control) . ".php")) {
            $controllerClass = $this->buildClass();
            $this->obj = new $controllerClass();
        } else {
            echo 'Controller File does not exist';
        }
    }

    function actionExists() {
        $action = $this->act . 'Action';

        if (method_exists($this->obj, $action)) {
            $this->obj->$action();
        }
    }

    function buildClass() {
        echo "<br />Class Name: " . $this->mod . '_Controller_' . ucfirst($this->control);
        return $this->mod . '_Controller_' . ucfirst($this->control);
    }

}