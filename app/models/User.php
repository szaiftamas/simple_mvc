<?php

namespace app\models;

use Core\Model;

class User extends Model {
    public function checkUser($username, $password) {
        $stmt = $this->db->prepare("SELECT users.id as userId, "
        . "CASE language "
        . "WHEN 'HU' THEN CONCAT(lastname, ' ', firstname) "
        . "ELSE CONCAT(firstname, ' ', lastname) "
        . "END as userName,"
        . "language as userLang "
        . "FROM `users` WHERE uniqueid = :username AND password = SHA2(:password,256)");
        $stmt->execute(['username' => $username, 'password' => $password]);
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $res;
    }
}
