<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Security-Policy" content="
          default-src 'none'; 
          script-src 'self'; 
          connect-src 'self'; 
          img-src data: 'self'; 
          style-src 'self' 'unsafe-inline';
          base-uri 'self';
          font-src 'self'">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GateKeeper</title>
    <!-- Google Fonts Roboto -->
    <link href="css/roboto_fonts.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/fontawesome-free-6.2.0-web-all.css" rel="stylesheet">
    <!-- MDB -->
    <link href="./mdb5/css/mdb.min.css" rel="stylesheet">
    <link href="css/setting.css" rel="stylesheet">
  </head>
  <body>
    <div class="d-flex justify-content-between bgc-light">
      <img src="./img/powered_by_s4f_2.png" class="header-img" style="display: block" alt="" loading="lazy"/>
      <?php require 'php_common/navbar_user.php'; ?>
    </div>
    <div class="row">
      <div class="col-xl-4">
        <div class="row mx-2">
          <h2 class="text-center"><?php lng("App Privileges") ?></h2>
          <div class="form-outline">
            <input id="ap_filter" class="form-control" type="text" autocomplete="one-time-code">
            <label class="form-label" for="ap_filter"><?php lng("Filter") ?></label> 
          </div>
          <div>
            <ul id="ap_tree">

            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="row mx-2">
          <h2 class="text-center"><?php lng("User Group") ?></h2>
          <div class="form-outline">
            <input id="ug_filter" class="form-control" type="text" autocomplete="one-time-code">
            <label class="form-label" for="ug_filter"><?php lng("Filter") ?></label> 
          </div>
          <div>
            <ul id="ug_tree">

            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="row mx-2">
          <h2 class="text-center"><?php lng("Users Hierarchy") ?></h2>
          <div class="form-outline">
            <input id="us_filter" class="form-control" type="text" autocomplete="one-time-code">
            <label class="form-label" for="us_filter"><?php lng("Filter") ?></label> 
          </div>
          <div>
            <ul id="us_tree">

            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="tree_modal" class="modal-setting text-center">
      <div id="tree_modal_content" class="modal-content-setting p-1 rounded-5">
        <button id="tree_modal_close" type="button" class="btn-close" style="float: left"></button>
        <div class="col">
          <h4 id="tree_selected"></h4>
        </div>
        <div class="col form-outline">
          <input id="tree_modal_input" class="form-control" type="text">
          <label class="form-label" for="tree_modal_input"><?php lng("Value to") ?></label> 
        </div>
        <div class="col mt-1">
          <div class="row">
            <div class="col-6"><button id="tree_modal_add_new" type="button" class="btn btn-primary w-100"><?php lng("Add New") ?></button></div>
            <div class="col-6"><button id="tree_modal_rename" type="button" class="btn btn-secondary w-100"><?php lng("Rename") ?></button></div>
          </div>
        </div>
        <div class="col mt-3">
          <button type="button" 
                  class="btn btn-danger w-100"
                  data-mdb-toggle="collapse"
                  data-mdb-target="#tree_modal_yes_cancel"
                  aria-expanded="false"
                  aria-controls="tree_modal_yes_cancel"><?php lng("Delete") ?></button>
        </div>
        <div id="tree_modal_yes_cancel" class="col mt-1 collapse">
          <div class="fs-4 fw-bold"><?php lng("Are you sure?") ?></div>
          <div class="row">
            <div class="col-6"><button id="tree_modal_yes" type="button" class="btn btn-warning w-100"><?php lng("Yes") ?></button></div>
            <div class="col-6"><button type="button" class="btn btn-secondary w-100"
                                       data-mdb-toggle="collapse"
                                       data-mdb-target="#tree_modal_yes_cancel"
                                       aria-expanded="false"
                                       aria-controls="tree_modal_yes_cancel"><?php lng("Cancel") ?></button></div>
          </div>
        </div>
      </div>
    </div>
    <div id="link_modal" class="modal-setting">
      <div id="link_modal_content" class="modal-content-setting p-1 rounded-5">
        <button id="link_modal_close" type="button" class="btn-close" style="float: left"></button>
        <div class="col text-center">
          <h4 id="link_selected"></h4>
        </div>
        <div class="col mt-1">
          <button id="link_modal_del" type="button" class="btn btn-danger w-100"><?php lng("Delete") ?>
        </div>
      </div>
    </div>

    <div id="user_modal" class="modal-setting text-center">
      <div id="user_modal_content" class="user-modal-content-setting p-1 rounded-5">
        <div class="row">
          <div class="col-1">
            <button id="user_modal_close" type="button" class="btn-close" style="float: left"></button>
          </div>
          <div class="col-11 d-flex">
            <button id="user_modal_modify" class="btn btn-primary me-1 w-100"><?php lng("Modify") ?></button>
            <button id="user_modal_add_new" class="btn btn-primary me-1 w-100"><?php lng("Add New") ?></button>
            <button id="user_modal_chg_manager" class="btn btn-primary ms-1 w-100"><?php lng("Chg. Manager") ?></button>
          </div>
        </div>
        <div class="d-flex">
          <div id="user_to_modify_div" class="fs-3 fw-bold" ><?php lng("User to modify") ?> -></div>
          <div id="add_subordinate_to_div" class="fs-3 fw-bold d-none"><?php lng("Add subordinate to") ?> -></div>
          <div id="change_manager_div" class="fs-3 fw-bold d-none"><?php lng("Change Manager") ?> -></div>
          <div id="user_selected" class="fs-3 fw-bold ms-2 text-primary"></div>
        </div>
        <div id="chg_manager_div" class="row mt-2 d-none">
          <div class="row">
            <div class="col-8">
              <div class = "form-outline mb-1"
                   autocomplete-table="users" 
                   dropdown_arrow="true">
                <input type="text" id="user_manager"class="form-control"/>
                <label class="form-label" for="user_manager"><?php lng("Manager") ?></label>
              </div>
            </div>
            <div class="col-4">
              <button id="user_modal_set_new_manager" class="btn btn-success w-100"><?php lng("Change") ?></button>
            </div>
          </div>
        </div>
        <div id="user_inputs_div">
          <div class="mt-2">
            <div class="form-outline mb-1" name="modal_form_outline_input">
              <input type="text" id="user_uniqueid" name="user_modal_input" class="form-control">
              <label class="form-label" for="user_uniqueid"><?php lng("Unique Id.") ?></label>
            </div>
          </div>
          <div class="mt-1">
            <div class="form-outline mb-1" name="modal_form_outline_input">
              <input type="text" id="user_first_name" name="user_modal_input" class="form-control">
              <label class="form-label" for="user_first_name"><?php lng("First Name") ?></label>
            </div>
          </div>
          <div class="mt-1">
            <div class="form-outline mb-1" name="modal_form_outline_input">
              <input type="text" id="user_last_name" name="user_modal_input" class="form-control">
              <label class="form-label" for="user_last_name"><?php lng("Last Name") ?></label>
            </div>
          </div>
          <div class="mt-1">
            <div class="form-outline mb-1" name="modal_form_outline_input">
              <input type="text" id="user_email" name="user_modal_input" class="form-control">
              <label class="form-label" for="user_email"><?php lng("E-mail") ?></label>
            </div>
          </div>
          <div class="mt-1">
            <select id="user_modal_active" class="select mb-1" data-mdb-placeholder="<?php lng("Active") ?>">
              <option value="-hidden_element-" hidden></option>
              <option value="0"><?php lng("No") ?></option>
              <option value="1"><?php lng("Yes") ?></option>
            </select>
            <label class="form-label select-label" for="user_modal_active"><?php lng("Active") ?></label>
          </div>
          <div class="mt-1">
            <select id="user_language" class="select mb-1" data-mdb-placeholder="<?php lng("Language") ?>">
              <option value="HU">HU</option>
              <option value="ENG">ENG</option>
            </select>
            <label class="form-label select-label" for="user_modal_language"><?php lng("Language") ?></label>
          </div>
          <div class="mt-3">
            <button id="user_modal_save" type="button" class="btn btn-success w-100"><?php lng("Save Changes") ?></button>
            <div id="user_modal_reset_del_div"class="row mt-2">
              <div class="col-6">
                <button id="user_modal_resetpw" type="button" 
                        class="btn btn-warning w-100" 
                        data-mdb-toggle="collapse"
                        data-mdb-target="#user_modal_yes_cancel_div"
                        aria-expanded="false"
                        aria-controls="user_modal_yes_cancel_div"><?php lng("Reset Password") ?></button>
              </div>
              <div class="col-6">
                <button id="user_modal_delete" type="button" 
                        class="btn btn-danger w-100"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#user_modal_yes_cancel_div"
                        aria-expanded="false"
                        aria-controls="user_modal_yes_cancel_div"><?php lng("Delete") ?></button>
              </div>
              <div id="user_modal_yes_cancel_div" class="col mt-1 collapse">
                <div class="fs-4 fw-bold"><?php lng("Are you sure?") ?></div>
                <div class="row">
                  <div class="col-6"><button id="user_modal_yes" type="button" class="btn btn-warning w-100"><?php lng("Yes") ?></button></div>
                  <div class="col-6"><button type="button" class="btn btn-secondary w-100"
                                             data-mdb-toggle="collapse"
                                             data-mdb-target="#user_modal_yes_cancel_div"
                                             aria-expanded="false"
                                             aria-controls="user_modal_yes_cancel_div"><?php lng("Cancel") ?></button></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Logout Modal -->
    <?php require './php_common/logout_modal.php'; ?>

    <!-- Change Password Modal -->
    <?php require './php_common/chgpsw_modal.php'; ?>

    <!-- Toast Container -->
    <?php require './php_common/toast_container.php'; ?>

    <script src="./mdb5/js/mdb.min.js"></script>
    <script src="./js_common/toast_handler.js?v1.0.1" type="text/javascript"></script>
    <script src="./js_common/xhttp_handler.js?v1.0.1" type="text/javascript"></script>
    <script src="./js_common/mdb_common.js?v1.0.1" type="text/javascript"></script>
    <script src="./js_common/fetch_handler.js?v1.0.1" type="text/javascript"></script>
    <script src="./js_common/class_autocomplete.js?v1.0.1" type="text/javascript"></script>
    <script src="./js_common/logout.js?v1.0.1" type="text/javascript"></script>
    <script src="./js_common/chgpsw.js?v1.0.1" type="text/javascript"></script>
    <script src="./js/classes_treehandler.js?v0.0.1" type="text/javascript"></script>
    <script src="./js/classes_users_prop.js?v0.0.1" type="text/javascript"></script>
    <script src="./js/classes_lang.js?v0.0.1" type="text/javascript"></script>
    <script src="./js/setting.js?v0.0.1" type="text/javascript"></script>

  </body>

</html>