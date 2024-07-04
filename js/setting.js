/* global failureHandler */
/* global mdb */

var trl = new translater();
var link_modal_el = document.getElementById("link_modal");
var link_modal_content_el = document.getElementById("link_modal_content");
var link_modal_close_el = document.getElementById("link_modal_close");
var link_selected_el = document.getElementById("link_selected");
var link_modal_del_el = document.getElementById("link_modal_del");
var tree_modal_el = document.getElementById("tree_modal");
var tree_modal_content_el = document.getElementById("tree_modal_content");
var tree_modal_close_el = document.getElementById("tree_modal_close");
var tree_selected_el = document.getElementById("tree_selected");
var tree_modal_input_el = document.getElementById("tree_modal_input");
var tree_modal_add_new_el = document.getElementById("tree_modal_add_new");
var tree_modal_rename_el = document.getElementById("tree_modal_rename");
var tree_modal_yes_el = document.getElementById("tree_modal_yes");
var tree_modal_yes_cancel_el = document.getElementById("tree_modal_yes_cancel");
var user_modal_el = document.getElementById("user_modal");
var user_modal_modify_el = document.getElementById("user_modal_modify");
var user_selected_el = document.getElementById("user_selected");
var user_inputs_div_el = document.getElementById("user_inputs_div");
var user_modal_content_el = document.getElementById("user_modal_content");
var user_modal_close_el = document.getElementById("user_modal_close");
var user_modal_save_el = document.getElementById("user_modal_save");
var user_modal_reset_del_div_el = document.getElementById("user_modal_reset_del_div");
var user_modal_add_new_el = document.getElementById("user_modal_add_new");
var user_modal_yes_el = document.getElementById("user_modal_yes");
var user_modal_yes_cancel_div_el = document.getElementById("user_modal_yes_cancel_div");
var user_modal_chg_manager_el = document.getElementById("user_modal_chg_manager");
var user_modal_resetpw_el = document.getElementById("user_modal_resetpw");
var user_modal_delete_el = document.getElementById("user_modal_delete");
var chg_manager_div_el = document.getElementById("chg_manager_div");
var user_modal_set_new_manager_el = document.getElementById("user_modal_set_new_manager");
var user_manager_el = document.getElementById("user_manager");
var user_manager_ddm_el = document.getElementById("user_manager_ddm");

var user_to_modify_div_el = document.getElementById("user_to_modify_div");
var add_subordinate_to_div_el = document.getElementById("add_subordinate_to_div");
var change_manager_div_el = document.getElementById("change_manager_div");
var user_uniqueid_el = document.getElementById("user_uniqueid");
var user_first_name_el = document.getElementById("user_first_name");
var user_last_name_el = document.getElementById("user_last_name");
var user_email_el = document.getElementById("user_email");
var user_modal_active_el = document.getElementById("user_modal_active");
var user_language_el = document.getElementById("user_language");

var ap_tree_handler;
var ap_tree_el = document.getElementById("ap_tree");
var ap_filter_el = document.getElementById("ap_filter");
var ug_tree_handler;
var ug_tree_el = document.getElementById("ug_tree");
var ug_filter_el = document.getElementById("ug_filter");
var us_tree_handler;
var us_tree_el = document.getElementById("us_tree");
var us_filter_el = document.getElementById("us_filter");
var users_prop_handler;

var selected_tree;
var tree_selected_id = 0;
var link_selected_id = 0;
var link_selected_name = "";
var link_parent_id = 0;

window.addEventListener("load", () => {
  load_tree();
  Autocomplete.init_autocomplete(document);
});

ap_filter_el.addEventListener("keyup", (evt) => {
  ap_tree_el.innerHTML = ap_tree_handler.get_inner_html(ap_tree_handler.set_filter(evt.target.value));
});

ug_filter_el.addEventListener("keyup", (evt) => {
  ug_tree_el.innerHTML = ug_tree_handler.get_inner_html(ug_tree_handler.set_filter(evt.target.value));
});

us_filter_el.addEventListener("keyup", (evt) => {
  us_tree_el.innerHTML = us_tree_handler.get_inner_html(us_tree_handler.set_filter(evt.target.value));
});

link_modal_el.addEventListener("click", (evt) => {
  if (evt.target === link_modal_el) {
    link_modal_el.style.display = "none";
  }
});

link_modal_close_el.addEventListener("click", () => {
  link_modal_el.style.display = "none";
});

tree_modal_el.addEventListener("click", (evt) => {
  if (evt.target === tree_modal_el) {
    tree_modal_el.style.display = "none";
  }
});

tree_modal_close_el.addEventListener("click", () => {
  tree_modal_el.style.display = "none";
});

user_modal_el.addEventListener("click", (evt) => {
  if (evt.target === user_modal_el) {
    user_modal_el.style.display = "none";
  }
});

user_modal_close_el.addEventListener("click", () => {
  user_modal_hide();
});

ap_tree_el.addEventListener("click", (evt) => {
  toggle_tree_node(ap_tree_handler, evt.target.getAttribute("key"));
});

ug_tree_el.addEventListener("click", (evt) => {
  toggle_tree_node(ug_tree_handler, evt.target.getAttribute("key"));
});

us_tree_el.addEventListener("click", (evt) => {
  toggle_tree_node(us_tree_handler, evt.target.getAttribute("key"));
});

ap_tree_el.addEventListener("contextmenu", (evt) => {
  tree_modal_block(evt, ap_tree_handler);
}, false);

ug_tree_el.addEventListener("contextmenu", (evt) => {
  tree_modal_block(evt, ug_tree_handler);
}, false);

us_tree_el.addEventListener("contextmenu", (evt) => {
  user_modal_block(evt, us_tree_handler);
}, false);

ug_tree_el.addEventListener("dragstart", (evt) => {
  evt.target.classList.add("bg-info");
  evt.dataTransfer.effectAllowed = 'move';
  evt.dataTransfer.setData('dragged_id', evt.target.id);
});

ug_tree_el.addEventListener("dragend", (evt) => {
  evt.target.classList.remove("bg-info");
});

us_tree_el.addEventListener("dragstart", (evt) => {
  evt.target.classList.add("bg-info");
  evt.dataTransfer.effectAllowed = 'move';
  evt.dataTransfer.setData('dragged_id', evt.target.id);
});

us_tree_el.addEventListener("dragend", (evt) => {
  evt.target.classList.remove("bg-info");
});

ap_tree_el.addEventListener("dragover", (evt) => {
  if (evt.preventDefault) {
    evt.preventDefault(); // Necessary. Allows us to drop.
  }
  if (typeof evt.target !== 'undefined' && evt.target.hasAttribute("droppable") && evt.target.id.length > 3 && evt.target.id.indexOf("_") !== -1) {
    var dragged_id = evt.dataTransfer.getData("dragged_id");
    if (dragged_id.indexOf("ug_li_") === 0) {
      var id = evt.target.id.substring(evt.target.id.lastIndexOf("_") + 1);
      if (ap_tree_handler.is_node(id)) {
        evt.target.classList.add("bg-secondary");
      }
    }
  }
});

ug_tree_el.addEventListener("dragover", (evt) => {
  if (evt.preventDefault) {
    evt.preventDefault(); // Necessary. Allows us to drop.
  }
  if (typeof evt.target !== 'undefined' && evt.target.hasAttribute("droppable") && evt.target.id.length > 3 && evt.target.id.indexOf("_") !== -1) {
    var dragged_id = evt.dataTransfer.getData("dragged_id");
    if (dragged_id.indexOf("us_li_") === 0) {
      var id = evt.target.id.substring(evt.target.id.lastIndexOf("_") + 1);
      if (ug_tree_handler.is_node(id)) {
        evt.target.classList.add("bg-secondary");
      }
    }
  }
});

ap_tree_el.addEventListener("dragleave", (evt) => {
  if (typeof evt.target.id !== 'undefined' && evt.target.id.length > 3 && evt.target.id.indexOf("_") !== -1) {
    evt.target.classList.remove("bg-secondary");
  }
});

ug_tree_el.addEventListener("dragleave", (evt) => {
  if (typeof evt.target.id !== 'undefined' && evt.target.id.length > 3 && evt.target.id.indexOf("_") !== -1) {
    evt.target.classList.remove("bg-secondary");
  }
});

ap_tree_el.addEventListener("drop", (evt) => {
  drop_handler(evt, ap_tree_handler, ug_tree_handler, success_ap_tree_drop_Handler);
});

function success_ap_tree_drop_Handler(resp, param) {
  tree_drop_handler(ap_tree_handler, ug_tree_handler, param);
}

ug_tree_el.addEventListener("drop", (evt) => {
  drop_handler(evt, ug_tree_handler, us_tree_handler, success_ug_tree_drop_Handler);
});

function success_ug_tree_drop_Handler(resp, param) {
  tree_drop_handler(ug_tree_handler, us_tree_handler, param);
}

function drop_handler(evt, target_tree, source_tree, callBack) {
  if (evt.stopPropagation) {
    evt.stopPropagation(); // Stops some browsers from redirecting.
  }
  const dragged_id = evt.dataTransfer.getData("dragged_id");
  if (evt.target.getAttribute("droppable") && dragged_id.indexOf(source_tree.get_li_prefix()) === 0) {
    var obj = new Object();
    obj.controller = "PageController";
    obj.methode = target_tree.get_prefix() + "_tree_drop";
    obj.trg_id = target_tree.reduce_id(evt.target.id);
    obj.src_id = source_tree.reduce_id(dragged_id);
    obj.parameter = [obj.trg_id, obj.src_id];
    callXHttp("/index.php", "POST", obj, null, callBack, failureHandler);
  }
}

function tree_drop_handler(target_tree, source_tree, param) {
  const target_node = target_tree.get_node(param[0]);
  const l_node = source_tree.get_link_node(param[1]);
  l_node.parent_name = target_node.name;
  target_tree.add_link(param[0], l_node);
  redraw_tree_node(target_tree, target_node.parent_id, 1);
}

link_modal_del_el.addEventListener("click", (evt) => {
  var obj = new Object();
  obj.controller = "PageController";
  obj.methode = "link_del";
  obj.selected_tree = selected_tree;
  obj.parent_id = link_parent_id;
  obj.selected_id = link_selected_id;
  callXHttp("/index.php", "POST", obj, null, success_link_del_Handler, failureHandler);
});

function success_link_del_Handler(resp) {
  switch (selected_tree) {
    case "ap":
      var parent_id = ap_tree_handler.del_link(link_parent_id, link_selected_id, link_selected_name);
      redraw_tree_node(ap_tree_handler, parent_id, 1);
      break;
    case "ug":
      var parent_id = ug_tree_handler.del_link(link_parent_id, link_selected_id, link_selected_name);
      redraw_tree_node(ug_tree_handler, parent_id, 1);
      break;
    case "us":
      var parent_id = us_tree_handler.del_link(link_parent_id, link_selected_id, link_selected_name);
      redraw_tree_node(us_tree_handler, parent_id, 1);
      break;
    default:

      break;
  }
  link_modal_el.style.display = "none";
}

tree_modal_yes_el.addEventListener("click", (evt) => {
  tree_del();
});

function tree_del() {
  var obj = new Object();
  obj.controller = "PageController";
  obj.methode = "tree_del";
  obj.selected_tree = selected_tree;
  obj.id = tree_selected_id;
  callXHttp("/index.php", "POST", obj, null, success_tree_del_Handler, failureHandler);
}

function success_tree_del_Handler(resp) {
  switch (selected_tree) {
    case "ap":
      var parent_id = ap_tree_handler.del_element(tree_selected_id);
      if (parseInt(parent_id) === 0) {
        ap_tree_el.innerHTML = ap_tree_handler.get_inner_html();
      } else {
        redraw_tree_node(ap_tree_handler, parent_id, 2);
      }
      break;
    case "ug":
      var parent_id = ug_tree_handler.del_element(tree_selected_id);
      if (parseInt(parent_id) === 0) {
        ug_tree_el.innerHTML = ug_tree_handler.get_inner_html();
      } else {
        redraw_tree_node(ug_tree_handler, parent_id, 2);
      }
      break;
    case "us":
      var parent_id = us_tree_handler.del_element(tree_selected_id);
      if (parseInt(parent_id) === 0) {
        us_tree_el.innerHTML = us_tree_handler.get_inner_html();
      } else {
        redraw_tree_node(us_tree_handler, parent_id, 2);
      }
      showToast("Success", trl.dict("User successfully deleted!"));
      user_modal_hide();

      break;

    default:

      break;
  }
  tree_modal_el.style.display = "none";
}

tree_modal_rename_el.addEventListener("click", (evt) => {
  var new_value = tree_modal_input_el.value;
  if (new_value.length > 2) {
    var obj = new Object();
    obj.controller = "PageController";
    obj.methode = "tree_rename";
    obj.selected_tree = selected_tree;
    obj.name = tree_modal_input_el.value;
    obj.id = tree_selected_id;
    obj.parameter = tree_modal_input_el.value;
    callXHttp("/index.php", "POST", obj, null, success_tree_rename_Handler, failureHandler);
  } else {
    showToast("Warning", trl.dict("Node is too short!"));
  }
});

function success_tree_rename_Handler(resp, node_name) {
  switch (selected_tree) {
    case "ap":
      var parent_id = ap_tree_handler.rename_element(tree_selected_id, node_name);
      redraw_tree_node(ap_tree_handler, parent_id, 1);
      break;
    case "ug":
      var parent_id = ug_tree_handler.rename_element(tree_selected_id, node_name);
      redraw_tree_node(ug_tree_handler, parent_id, 1);
      break;
    case "us":
      var parent_id = us_tree_handler.rename_element(tree_selected_id, node_name);
      redraw_tree_node(us_tree_handler, parent_id, 1);
      break;

    default:

      break;
  }
  tree_modal_el.style.display = "none";
}

tree_modal_add_new_el.addEventListener("click", (evt) => {
  var new_value = tree_modal_input_el.value;
  if (new_value.length > 2) {
    var sel_tree = null;
    switch (selected_tree) {
      case "ap":
        sel_tree = ap_tree_handler.get_node(tree_selected_id);
        break;
      case "ug":
        sel_tree = ug_tree_handler.get_node(tree_selected_id);
        break;
      case "us":
        sel_tree = us_tree_handler.get_node(tree_selected_id);
        break;
    }
    if (sel_tree === null || sel_tree.links.size !== 0) {
      showToast("Warning", trl.dict("Can not add node!"));
      return;
    }
    var obj = new Object();
    obj.controller = "PageController";
    obj.methode = "tree_add_new";
    obj.selected_tree = selected_tree;
    obj.name = tree_modal_input_el.value;
    obj.parent_id = tree_selected_id;
    obj.parameter = tree_modal_input_el.value;
    callXHttp("/index.php", "POST", obj, null, success_tree_add_new_Handler, failureHandler);
  } else {
    showToast("Warning", trl.dict("Node is too short!"));
  }
});

function success_tree_add_new_Handler(resp, node_name) {
  switch (selected_tree) {
    case "ap":
      ap_tree_handler.add_element(tree_selected_id, node_name, resp["last_insert_id"]);
      var parent_id = ap_tree_handler.get_parent_node_id(tree_selected_id);
      if (parseInt(parent_id) === 0) {
        ap_tree_el.innerHTML = ap_tree_handler.get_inner_html();
      } else {
        redraw_tree_node(ap_tree_handler, parent_id, 2);
      }
      break;
    case "ug":
      ug_tree_handler.add_element(tree_selected_id, node_name, resp["last_insert_id"]);
      var parent_id = ug_tree_handler.get_parent_node_id(tree_selected_id);
      if (parseInt(parent_id) === 0) {
        ug_tree_el.innerHTML = ug_tree_handler.get_inner_html();
      } else {
        redraw_tree_node(ug_tree_handler, parent_id, 2);
      }
      break;
    case "us":
      us_tree_handler.add_element(tree_selected_id, node_name, resp["last_insert_id"]);
      var parent_id = us_tree_handler.get_parent_node_id(tree_selected_id);
      if (parseInt(parent_id) === 0) {
        us_tree_el.innerHTML = us_tree_handler.get_inner_html();
      } else {
        redraw_tree_node(us_tree_handler, parent_id, 2);
      }
      break;

    default:

      break;
  }
  tree_modal_el.style.display = "none";
}

function redraw_tree_node(tree, id, level) {
  toggle_tree_node(tree, id);
  toggle_tree_node(tree, id, level);
}

function toggle_tree_node(tree, id, level = 1) {
  var act_ul = document.getElementById(tree.get_ul_prefix() + id);
  var act_li = document.getElementById(tree.get_li_prefix() + id);
  if (act_ul === null) {
    return;
  }
  if (tree.is_child_displayed(id)) {
    act_ul.innerHTML = "";
    tree.clr_is_child_displayed(id);

  } else {
    act_ul.innerHTML = tree.get_node_inner_html(id, level);
    tree.set_is_child_displayed(id);
    if (!tree.is_parent_draggable()) {
      act_li.removeAttribute("draggable");
    }
    if (tree.get_prefix() === "us") {
      users_prop_handler.set_inactive_background();
    }
}
}

function tree_modal_block(evt, tree_handler) {
  var evt_trg = evt.target;
  if (tree_handler.get_tree_modifiable() && evt_trg.hasAttribute("key") && tree_handler.is_node(evt_trg.getAttribute("key"))) {
    if (evt_trg.firstChild.data === 'Root') {
      //    return;
    }
    selected_tree = tree_handler.get_prefix();
    tree_selected_id = evt_trg.getAttribute("key");
    tree_selected_el.innerHTML = evt_trg.firstChild.data;
    tree_modal_yes_cancel_el.classList.remove("show");
    tree_modal_el.style.display = "block";
    tree_modal_content_el.style.left = evt.clientX + "px";
    tree_modal_content_el.style.top = evt.clientY + "px";
    tree_modal_input_el.value = "";
    tree_modal_input_el.focus();
    evt.preventDefault();
  } else if (evt_trg.hasAttribute("parent_key") && evt_trg.hasAttribute("link_key")) {
    evt.preventDefault();
    selected_tree = tree_handler.get_prefix();
    link_selected_id = evt_trg.getAttribute("link_key");
    link_selected_name = evt_trg.firstChild.data;
    link_parent_id = evt_trg.getAttribute("parent_key");
    link_selected_el.innerHTML = evt_trg.firstChild.data;
    link_modal_el.style.display = "block";
    link_modal_content_el.style.left = evt.clientX + "px";
    link_modal_content_el.style.top = evt.clientY + "px";
  }
}

user_modal_delete_el.addEventListener("click", (evt) => {
  user_modal_yes_el.setAttribute('function', 'delete_user');
  user_modal_yes_el.classList.remove('btn-warning');
  user_modal_yes_el.classList.add('btn-danger');

});

user_modal_resetpw_el.addEventListener("click", (evt) => {
  user_modal_yes_el.setAttribute('function', 'reset_pw');
  user_modal_yes_el.classList.remove('btn-danger');
  user_modal_yes_el.classList.add('btn-warning');
});

user_modal_save_el.addEventListener("click", (evt) => {
  const obj = new Object();
  obj.controller = "PageController";
  obj.methode = user_modal_save_el.hasAttribute('new_user') ? "new_user" : "update_user";
  document.getElementsByName("user_modal_input").forEach((umi) => obj[umi.id] = umi.value);
  obj.user_modal_active = user_modal_active_el.value;
  obj.user_language = user_language_el.value;
  obj.row_id = tree_selected_id;
  if (!user_modal_input_validator(obj)) {
    return;
  }
  obj.parameter = {...obj};
  callXHttp("/setting_api", "POST", obj, null, successUserModalSaveHandler, failureHandler);
});

function successUserModalSaveHandler(resp, param) {
  if (user_modal_save_el.hasAttribute('new_user')) {
    param.row_id = resp["last_insert_id"];
    users_prop_handler.add_user(param);
    success_tree_add_new_Handler(resp, param.user_uniqueid);
    user_modal_reset_inputs();
  } else {
    users_prop_handler.update_user_prop(param);
    success_tree_rename_Handler(resp, param.user_uniqueid);
    user_modal_hide();
  }
  if ((param.user_modal_active + "") === "0") {
    document.getElementById("us_li_" + param.row_id).classList.add("bg-secondary");
  } else {
    document.getElementById("us_li_" + param.row_id).classList.remove("bg-secondary");
  }
}

function user_modal_input_validator(obj) {
  if (obj.user_uniqueid.length < 3) {
    showToast("Warning", trl.dict("Unique Id. is min. 3 character!"));
    return false;
  }
  if (obj.user_modal_active.length !== 1) {
    showToast("Warning", trl.dict("Active must be set!"));
    return false;
  }
  return true;
}

user_modal_yes_el.addEventListener("click", (evt) => {
  var obj = new Object();
  obj.controller = "PageController";
  obj.methode = user_modal_yes_el.getAttribute('function');
  obj.users_id = tree_selected_id;
  obj.parameter = user_modal_yes_el.getAttribute('function');
  callXHttp("/index.php", "POST", obj, null, successDelOrResetHandler, failureHandler);

});

function successDelOrResetHandler(resp, param) {
  switch (param) {
    case "reset_pw":
      showToast("Success", trl.dict("Password is same to the uniqueid!"));
      user_modal_yes_cancel_div_el.classList.remove('show');
      break;

    case "delete_user":
      tree_del();
      break;

    default:

      break;
  }
}

user_modal_set_new_manager_el.addEventListener("click", (evt) => {
  var obj = new Object();
  obj.controller = "PageController";
  obj.methode = "set_new_manager";
  obj.users_id = tree_selected_id;
  obj.manager_id = user_manager_el.getAttribute("row_id");
  callXHttp("/setting_api", "POST", obj, null, successUserModalSetNewManagerHandler, failureHandler);

});

function successUserModalSetNewManagerHandler(resp) {
  us_tree_handler = new tree_handler(resp["us_tree"], null, "us");
  us_tree_handler.set_draggable();
  us_tree_el.innerHTML = us_tree_handler.get_inner_html();
  users_prop_handler = new users_prop(resp["us_prop"]);
  user_modal_hide();
}

user_modal_chg_manager_el.addEventListener("click", (evt) => {
  chg_manager_div_el.classList.remove("d-none");
  user_inputs_div_el.classList.add("d-none");
  user_modal_page_id_set(change_manager_div_el);
  user_modal_content_el.classList.add('user-modal-add-new');

});

user_modal_add_new_el.addEventListener("click", (evt) => {
  chg_manager_div_el.classList.add("d-none");
  user_inputs_div_el.classList.remove("d-none");
  user_modal_page_id_set(add_subordinate_to_div_el);

  user_modal_reset_del_div_el.classList.add('d-none');
  user_modal_content_el.classList.add('user-modal-add-new');
  user_modal_save_el.setAttribute('new_user', true);
  user_modal_reset_inputs(change_manager_div_el);

});

user_modal_modify_el.addEventListener("click", (evt) => {
  chg_manager_div_el.classList.add("d-none");
  user_inputs_div_el.classList.remove("d-none");
  user_modal_page_id_set(user_to_modify_div_el);

  user_modal_reset_del_div_el.classList.remove('d-none');
  user_modal_content_el.classList.remove('user-modal-add-new');
  user_modal_save_el.removeAttribute('new_user');
  user_modal_set_inputs();

});

function user_modal_page_id_set(el) {
  user_to_modify_div_el.classList.add("d-none");
  add_subordinate_to_div_el.classList.add("d-none");
  change_manager_div_el.classList.add("d-none");
  el.classList.remove("d-none");
}

function user_modal_hide() {
  user_modal_el.style.display = "none";
  user_modal_content_el.classList.remove('user-modal-add-new');
  user_modal_reset_del_div_el.classList.remove('d-none');
  user_modal_save_el.removeAttribute('new_user');
  chg_manager_div_el.classList.add("d-none");
  user_inputs_div_el.classList.remove("d-none");
  user_modal_yes_cancel_div_el.classList.remove('show');
  user_modal_page_id_set(user_to_modify_div_el);
  user_modal_reset_inputs();
}

function user_modal_reset_inputs() {
  user_manager_el.removeAttribute('row_id');
  document.getElementsByName("user_modal_input").forEach((umi) => umi.value = "");
  for (const optionEl of user_modal_active_el.options) {
    optionEl.removeAttribute('selected');
  }
  mdb.Select.getInstance(user_modal_active_el).setValue('-hidden_element-');
  for (const optionEl of user_language_el.options) {
    optionEl.removeAttribute('selected');
  }
  mdb.Select.getInstance(user_language_el).setValue('HU');
  user_uniqueid_el.focus();
}

function user_modal_block(evt, tree) {
  var evt_trg = evt.target;
  if (evt_trg.hasAttribute("key") && tree.is_node(evt_trg.getAttribute("key"))) {
    selected_tree = tree.get_prefix();
    tree_selected_id = evt_trg.getAttribute("key");
    user_selected_el.innerHTML = evt_trg.firstChild.data;
    user_modal_el.style.display = "block";
    user_modal_set_inputs();
    evt.preventDefault();
  }
}

function user_modal_set_inputs() {
  const user_prop = users_prop_handler.get_user_prop(tree_selected_id);
  user_uniqueid_el.value = user_prop.uniqueid;
  user_first_name_el.value = user_prop.firstname;
  user_last_name_el.value = user_prop.lastname;
  user_email_el.value = user_prop.email;
  document.getElementsByName("modal_form_outline_input").forEach((mfoi) => {
    new mdb.Input(mfoi).update();
  });
  mdb.Select.getInstance(user_modal_active_el).setValue(user_prop.isactive + "");
  mdb.Select.getInstance(user_language_el).setValue(user_prop.language);

}

function load_tree() {
  var obj = new Object();
  obj.controller = "PageController";
  obj.methode = "load_tree";
  callXHttp("index.php", "POST", obj, null, success_load_trees_Handler, failureHandler);
}

function success_load_trees_Handler(resp) {
  // console.log(resp);
  ap_tree_handler = new tree_handler(resp["ap_tree"], resp["ap_link"], "ap");
  ap_tree_handler.set_droppable();
  ap_tree_el.innerHTML = ap_tree_handler.get_inner_html();
  ug_tree_handler = new tree_handler(resp["ug_tree"], resp["ug_link"], "ug");
  ug_tree_handler.set_draggable();
  ug_tree_handler.set_droppable();
  ug_tree_handler.set_tree_modifiable();
  ug_tree_el.innerHTML = ug_tree_handler.get_inner_html();
  us_tree_handler = new tree_handler(resp["us_tree"], null, "us");
  us_tree_handler.set_draggable();
  us_tree_handler.set_parent_draggable();
  us_tree_el.innerHTML = us_tree_handler.get_inner_html();
  users_prop_handler = new users_prop(resp["us_prop"]);
  users_prop_handler.set_inactive_background();
}