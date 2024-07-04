<?php

namespace App\controllers;

use Core\Model;

class DDMController extends Model {

  public function users($filter) {
    $resp = [];
    $query = "SELECT id,`uniqueid` FROM `users` WHERE `uniqueid` LIKE ? AND `uniqueid` NOT LIKE 's4f_%' ORDER BY uniqueid LIMIT 21;";
    $stmt = $this->db->prepare($query);
    $stmt->execute(['%' . $filter . '%']);
    $resp["results"] = $stmt->fetchAll(\PDO::FETCH_NUM);
    $resp["success"] = true;
    echo json_encode($resp);
  }

}
