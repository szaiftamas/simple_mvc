<?php

namespace App\controllers;

use Core\Model;

class PageController extends Model {

  public function delete_user($users_id) {
    $query_delete_user = "DELETE FROM users WHERE id = ?;";
    $stmt_delete_user = $this->db->prepare($query_delete_user);
    $stmt_delete_user->execute([$users_id]);
    echo '{}';
  }

  public function reset_pw($users_id) {
    $query_reset_pw = "UPDATE users SET password = SHA2(uniqueid,256) WHERE id = ?;";
    $stmt_reset_pw = $this->db->prepare($query_reset_pw);
    $stmt_reset_pw->execute([$users_id]);
    echo '{}';
  }

  public function set_new_manager($users_id, $manager_id) {
    $resp = [];
    if (intval($manager_id) === intval($users_id)) {
      http_response_code(403);
      echo lng("Self-managent is not possibe!");
      die();
    }
    $query_set_manager = "UPDATE users SET manager_id = ? WHERE id = ?;";
    $stmt_set_manager = $this->db->prepare($query_set_manager);
    $stmt_set_manager->execute([$manager_id, $users_id]);
    $this->set_us_prop($resp);
    echo json_encode($resp);
  }

  public function new_user($user_uniqueid, $user_first_name, $user_last_name, $user_email, $user_modal_active, $user_language, $manager_id) {
    $resp = [];
    $query = "INSERT INTO users(uniqueid,firstname,lastname,email,isactive,language,manager_id) VALUES(?,?,?,?,?,?,?);";
    $stmt = $this->db->prepare($query);
    $exec_arr = [
        $user_uniqueid,
        $user_first_name,
        $user_last_name,
        $user_email,
        $user_modal_active,
        $user_language,
        $manager_id
    ];
    $stmt->execute($exec_arr);
    $resp["last_insert_id"] = $this->db->lastInsertId();
    echo json_encode($resp);
  }

  public function update_user($user_uniqueid, $user_first_name, $user_last_name, $user_email, $user_modal_active, $user_language, $users_id) {
    $resp = [];
    $query = "UPDATE users SET uniqueid = ?,firstname = ?,lastname = ?,email = ?,isactive = ?,language = ? WHERE id = ?;";
    $stmt = $this->db->prepare($query);
    $exec_arr = [
        $user_uniqueid,
        $user_first_name,
        $user_last_name,
        $user_email,
        $user_modal_active,
        $user_language,
        $users_id
    ];
    $stmt->execute($exec_arr);
    $resp["last_insert_id"] = $this->db->lastInsertId();
    echo json_encode($resp);
  }

  public function link_del($selected_tree, $parent_id, $selected_id) {
    switch ($selected_tree) {
      case "ap":
        $query_del = "DELETE FROM link_app_privileges_users_group WHERE app_privileges_id = ? AND users_group_id = ?;";
        break;
      case "ug":
        $query_del = "DELETE FROM link_users_group WHERE users_group_id = ? AND users_id = ?;";
        break;
      default:
        break;
    }
    $stmt_del = $this->db->prepare($query_del);
    $stmt_del->execute([$parent_id, $selected_id]);
    echo "{}";
  }

  public function ap_tree_drop($trg_id, $src_id) {
    $query_lapug_insert = "INSERT INTO link_app_privileges_users_group(app_privileges_id,users_group_id) VALUES(?,?);";
    $stmt_lapug_insert = $this->db->prepare($query_lapug_insert);
    $stmt_lapug_insert->execute([$trg_id, $src_id]);
    echo "{}";
  }

  public function ug_tree_drop($trg_id, $src_id) {
    $query_lug_insert = "INSERT INTO link_users_group(users_group_id,users_id) VALUES(?,?);";
    $stmt_lug_insert = $this->db->prepare($query_lug_insert);
    $stmt_lug_insert->execute([$trg_id, $src_id]);
    echo "{}";
  }

  public function tree_del($selected_tree, $id) {
    switch ($selected_tree) {
      case "ap":
        $query_del = "DELETE FROM app_privileges WHERE id = ?;";
        break;
      case "ug":
        $query_del = "DELETE FROM users_group WHERE id = ?;";
        break;
      case "us":
        $query_del = "DELETE FROM users WHERE id = ?;";
        break;
      default:
        break;
    }
    $stmt_del = $this->db->prepare($query_del);
    $stmt_del->execute([$id]);
    echo "{}";
  }

  public function tree_rename($selected_tree, $name, $id) {
    switch ($selected_tree) {
      case "ap":
        $query_rename = "UPDATE app_privileges SET `name` = ? WHERE id = ?;";
        break;
      case "ug":
        $query_rename = "UPDATE users_group SET `name` = ? WHERE id = ?;";
        break;
      case "us":
        $query_rename = "UPDATE users_hierarchy SET `name` = ? WHERE id = ?;";
        break;
      default:
        break;
    }
    $stmt_rename = $this->db->prepare($query_rename);
    $stmt_rename->execute([$name, $id]);
    echo "{}";
  }

  public function tree_add_new($selected_tree, $name, $parent_id) {
    $resp = [];
    switch ($selected_tree) {
      case "ap":
        $query_add_new = "INSERT INTO app_privileges(`name`,app_privileges_id) VALUES(?,?);";
        break;
      case "ug":
        $query_add_new = "INSERT INTO users_group(`name`,users_group_id) VALUES(?,?);";
        break;
      case "us":
        $query_add_new = "INSERT INTO users_hierarchy(`name`,users_hierarchy_id) VALUES(?,?);";
        break;
      default:
        break;
    }
    $stmt_add_new = $this->db->prepare($query_add_new);
    $stmt_add_new->execute([$name, $parent_id]);
    $resp["last_insert_id"] = $this->db->lastInsertId();
    echo json_encode($resp);
  }

  public function load_tree() {
    $resp = [];
    $this->set_ap_prop($resp);
    $this->set_ug_prop($resp);
    $this->set_us_prop($resp);
    echo json_encode($resp);
  }

  public function logout() {
    session_unset();
    echo "{}";
  }

  function set_ap_prop(&$resp) {
    $query_ap = "
WITH RECURSIVE tree_view (cur_path, app_privileges_id, id) AS (     
	SELECT CAST(`name` AS CHAR(100)), app_privileges_id, id 
	FROM app_privileges 
    WHERE `name`='Root'   
	UNION     
	SELECT CONCAT(tree_view.cur_path, ' -> ', app_privileges.`name`), app_privileges.app_privileges_id, app_privileges.id        
	FROM tree_view, app_privileges        
	WHERE tree_view.id = app_privileges.app_privileges_id ) 
SELECT * FROM tree_view;";
    $stmt_ap = $this->db->prepare($query_ap);
    $stmt_ap->execute();
    $resp["ap_tree"] = $stmt_ap->fetchAll(\PDO::FETCH_ASSOC);
    $query_ap_link = "SELECT app_privileges_id,ug.id as left_side_id,ug.`name` as left_side_name "
            . "FROM link_app_privileges_users_group as lapug "
            . "LEFT JOIN users_group as ug ON ug.id = lapug.users_group_id;";
    $resp["ap_link"] = $this->db->query($query_ap_link)->fetchAll(\PDO::FETCH_GROUP);
  }

  function set_ug_prop(&$resp) {
    $query_ug = "
WITH RECURSIVE tree_view (cur_path, users_group_id, id) AS (     
	SELECT CAST(`name` AS CHAR(100)), users_group_id, id 
	FROM users_group 
    WHERE `name`='Root'   
	UNION     
	SELECT CONCAT(tree_view.cur_path, ' -> ', users_group.`name`), users_group.users_group_id, users_group.id        
	FROM tree_view, users_group        
	WHERE tree_view.id = users_group.users_group_id AND users_group.`name` != 'S4F') 
SELECT * FROM tree_view;";
    $stmt_ug = $this->db->prepare($query_ug);
    $stmt_ug->execute();
    $resp["ug_tree"] = $stmt_ug->fetchAll(\PDO::FETCH_ASSOC);
    $query_ap_link = "SELECT users_group_id,u.id as left_side_id,u.uniqueid as left_side_name "
            . "FROM link_users_group as lug "
            . "LEFT JOIN users as u ON u.id = lug.users_id;";
    $resp["ug_link"] = $this->db->query($query_ap_link)->fetchAll(\PDO::FETCH_GROUP);
  }

  function set_us_prop(&$resp) {
    $query_us = "
WITH RECURSIVE tree_view (cur_path, manager_id, id) AS (     
	SELECT CAST(`uniqueid` AS CHAR(100)), manager_id, id 
	FROM users 
    WHERE `uniqueid` = 'Root'   
	UNION     
	SELECT CONCAT(tree_view.cur_path, ' -> ', users.`uniqueid`), users.manager_id, users.id        
	FROM tree_view, users        
	WHERE tree_view.id = users.manager_id AND LEFT(users.`uniqueid`,4) != 's4f_') 
SELECT * FROM tree_view;";
    $stmt_us = $this->db->prepare($query_us);
    $stmt_us->execute();
    $resp["us_tree"] = $stmt_us->fetchAll(\PDO::FETCH_ASSOC);
    $query_us_prop = "SELECT id,uniqueid,firstname,lastname,email,isactive,language FROM users WHERE id IN(" . implode(',', array_column($resp["us_tree"], "id")) . ");";
    $resp["us_prop"] = $this->db->query($query_us_prop)->fetchAll(\PDO::FETCH_ASSOC);
  }

}
