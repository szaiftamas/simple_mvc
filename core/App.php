<?php

namespace Core;

class App {

  protected $controller = 'AuthController';
  protected $method = 'index';
  protected $params = [];

  public function __construct() {
    if (isset($_POST['controller'])) {
      $this->controller = $_POST['controller'];
    }
    $controllerClass = 'App\\Controllers\\' . $this->controller;
    if (class_exists($controllerClass)) {
      $this->controller = new $controllerClass;
    } else {
      throw new \Exception("Controller class $controllerClass not found");
    }

    if (isset($_POST['methode'])) {
      if (method_exists($this->controller, $_POST['methode'])) {
        $this->method = $_POST['methode'];
      }
    }
    $data = array();
    foreach ($_POST as $key => $value) {
      if ($key !== "controller" && $key != "methode") {
        $data[] = $value;
      }
    }
    call_user_func_array([$this->controller, $this->method], $data);
  }

}
