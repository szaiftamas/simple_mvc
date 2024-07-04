<?php

namespace Core;

class Model {

  protected $db;

  public function __construct() {
    $databaseUrl = "mysql:host=127.0.0.1;dbname=simple_mvc;charset=utf8";
    $databaseUser = "php";
    $databasePassword = "phppass";

    $options = [
        \PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    $this->db = new \PDO($databaseUrl, $databaseUser, $databasePassword, $options);
  }

}
