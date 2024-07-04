<?php

namespace App\controllers;

use Core\Controller;

class AuthController extends Controller {

  public function index() {
    if (isset($_SESSION[$GLOBALS["site"]]['user'])) {
      $this->view('setting');
    } else {
      $this->view('login');
    }
  }

  public function login() {
    $user = $this->model('User');
    $result = $user->checkUser($_POST['username'], $_POST['password']);
    if ($result) {
      $_SESSION[$GLOBALS["site"]]['user'] = $result["userName"];
      $_SESSION[$GLOBALS["site"]]["lang"] = $result["userLang"];
      $this->view('setting');
    } else {
      $this->view('login', ['error' => 'Invalid credentials']);
    }
  }

}
