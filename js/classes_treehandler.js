class tree_handler {
  tree_content = new tree_node("Entry", 0, true);
  id_path = new Map();
  prefix = 'na';
  is_draggable = false;
  parent_draggable = false;
  is_droppable = false;
  is_tree_modifiable = false;
  tree_nodes = new Array();
  link_nodes = new Array();

  constructor(tree_rows, links, prefix) {
    this.prefix = prefix;
    tree_rows.forEach((row) => {
      var path_arr = row["cur_path"].split(' -> ');
      var act_tree_node = this.tree_content;
      var dept = 0;
      path_arr.forEach((node) => {
        dept++;
        if (!act_tree_node.childs.has(node)) {
          const new_tree_node = new tree_node(node, row["id"], act_tree_node.id);
          act_tree_node.childs.set(node, new_tree_node);
          this.tree_nodes.push(new_tree_node);
        }
        act_tree_node = act_tree_node.childs.get(node);

      });
      if (links !== null && links.hasOwnProperty(row["id"])) {
        links[row["id"]].forEach((linked_user_prop) => {
          const new_link_node = new link_node(linked_user_prop.left_side_name, linked_user_prop.left_side_id, act_tree_node.name);
          act_tree_node.links.set(linked_user_prop.left_side_id + "", new_link_node);
          this.link_nodes.push(new_link_node);
        })
      }
      this.id_path.set(row["id"] + "", path_arr);
    });
  }

  get_link_node(id) {
    var tn = this.get_node(id);
    return new link_node(tn.name, tn.id);
  }

  del_link(node_id, link_node_id, link_name) {
    var node = this.get_node(node_id);
    const indexOfObject = this.link_nodes.findIndex(obj => {
      return obj.id === this.reduce_id(link_node_id)
              && obj.parent_name === link_name;
    });
    this.link_nodes.splice(indexOfObject, 1);
    node.links.delete(this.reduce_id(link_node_id));
    return node.parent_id;
  }

  add_link(node_id, new_link_node) {
    var node = this.get_node(node_id);
    new_link_node.parent_id = node.id;
    node.links.set(new_link_node.id + "", new_link_node);
    this.link_nodes.push(new_link_node);
  }

  set_tree_modifiable(){
    this.is_tree_modifiable = true;
  }
  
  get_tree_modifiable(){
    return this.is_tree_modifiable;
  }

  set_draggable() {
    this.is_draggable = true;
  }

  set_parent_draggable() {
    this.parent_draggable = true;
  }

  is_parent_draggable() {
    return this.parent_draggable;
  }

  set_droppable() {
    this.is_droppable = true;
  }

  get_prefix() {
    return this.prefix;
  }

  get_ul_prefix() {
    return this.prefix + "_ul_";
  }

  get_li_prefix() {
    return this.prefix + "_li_";
  }

  get_span_prefix() {
    return this.prefix + "_span_";
  }

  set_filter(filter) {
    this.clear_is_filtered(this.tree_content.childs.get("Root"));
    if (filter === null || filter.length === 0) {
      return false;
    }
    filter = filter.toLowerCase();
    this.set_is_filtered(filter);
    this.link_nodes
            .filter(({name}) => name.toLowerCase().indexOf(filter) !== -1)
            .forEach(l_node => {
              l_node.is_filtered = true;
              this.set_is_filtered(l_node.parent_name.toLowerCase());
            });

    return true;
  }

  set_is_filtered(filter) {
    this.id_path.forEach((value) => {
      if (value[value.length - 1].toLowerCase().indexOf(filter) !== -1) {
        var act_tree_node = this.tree_content;
        value.forEach((element) => {
          act_tree_node = act_tree_node.childs.get(element);
          act_tree_node.is_filtered = true;
        });
      }
    });
  }

  clear_is_filtered(t_node) {
    t_node.is_filtered = false;
    t_node.links.forEach((linked) => {
      linked.is_filtered = false;
    })
    t_node.childs.forEach((child_node) => {
      this.clear_is_filtered(child_node);
    });
  }

  del_element(id) {
    const act_node_name = this.get_node(id).name;
    var parent_node = this.get_parent_node(id);
    parent_node.childs.delete(act_node_name);
    const indexOfObject = this.tree_nodes.findIndex(obj => {
      return obj.id === this.reduce_id(id);
    });
    this.tree_nodes.splice(indexOfObject, 1);
    return parent_node.parent_id;
  }

  rename_element(id, node_name) {
    var act_node = this.get_node(id);
    act_node.name = node_name;
    var id_path = this.id_path.get(this.reduce_id(id));
    id_path[id_path.size - 1] = node_name;
    return act_node.parent_id;
  }

  add_element(parent_id, node_name, node_id) {
    parent_id = this.reduce_id(parent_id);
    node_id = this.reduce_id(node_id);
    var act_node = this.get_node(parent_id);
    var shallow_id_path = [...this.id_path.get(parent_id)];
    shallow_id_path.push(node_name);
    this.id_path.set(node_id, shallow_id_path);
    const new_tree_node = new tree_node(node_name, node_id, act_node.id);
    act_node.childs.set(node_name, new_tree_node);
    act_node.is_child_displayed = true;
    this.tree_nodes.push(new_tree_node);
  }

  get_parent_node_id(id) {
    return this.get_node(id).parent_id;
  }

  get_parent_node(id) {
    return this.get_node(this.get_parent_node_id(id));
  }

  is_node(id) {
    if (id === null) {
      return false;
    }
    return this.id_path.has(this.reduce_id(id));
  }

  set_is_child_displayed(id) {
    this.get_node(id).is_child_displayed = true;
  }

  clr_is_child_displayed(id) {
    this.get_node(id).is_child_displayed = false;
  }

  is_child_displayed(id) {
    if (id === null) {
      return false;
    }
    return this.get_node(id).is_child_displayed;
  }

  get_node(id) {
    return this.tree_nodes.find((t_nodes) => t_nodes.id === this.reduce_id(id));
  }
  
  get_inner_html(is_filtered = false) {
    var res = {'inner_html': ''};
    this.recursive_call(res, this.tree_content.childs.get("Root"), 1, 3, is_filtered);
    return res.inner_html;
  }

  get_node_inner_html(id, max_level = 1) {
    var act_node = this.get_node(id);
    var res = {'inner_html': ''};
    if (act_node.childs.size !== 0) {
      this.drill_down_level(res, act_node, 1, max_level);
    }
    return res.inner_html;
  }

  recursive_call(res, t_node, level, max_level, is_filtered = false) {
    if (is_filtered && !t_node.is_filtered) {
      t_node.is_child_displayed = false;
      return;
    }
    if (t_node.childs.size === 0) {
      res.inner_html += '<div>';
      res.inner_html += '<li>';
      res.inner_html += '<span ' + (this.is_droppable ? 'droppable="true" ' : '') + (this.is_draggable ? 'draggable="true" ' : '') + 'id="' + this.prefix + '_li_' + t_node.id + '" key="' + t_node.id + '">' + t_node.name + '</span>';
      res.inner_html += '</li>';
      
      res.inner_html += '<div class="ms-2 row">';
      t_node.links.forEach((link) => {
        if (!is_filtered || link.is_filtered) {
          res.inner_html += '<span class="ms-3 text-primary" parent_key="' + t_node.id + '" link_key="' + link.id + '">' + link.name + '</span>';
        }
      });
      res.inner_html += '</div></div>';
    } else {
      const is_drill_down = is_filtered || level < max_level || t_node.is_child_displayed;
      res.inner_html += '<li>';
      res.inner_html += '<span ' + (((!is_drill_down || this.parent_draggable) && t_node.name !== 'Root') ? 'draggable="true" ' : '') + 'id="' + this.prefix + '_li_' + t_node.id + '" class="caret" key="' + t_node.id + '">' + t_node.name + "</span>";
      res.inner_html += '<ul id="' + this.prefix + "_ul_" + t_node.id + '">';
      if (is_drill_down) {
        this.drill_down_level(res, t_node, level + 1, max_level, is_filtered);
      } else {
        t_node.is_child_displayed = false;
      }
      res.inner_html += '</ul></li>';
  }
  }

  drill_down_level(res, t_node, level, max_level, is_filtered = false) {
    t_node.is_child_displayed = true;
    t_node.childs.forEach((child_node, key) => {
      this.recursive_call(res, child_node, level, max_level, is_filtered);
    });
  }

  reduce_id(id) {
    id = id + "";
    if (id.indexOf("_") !== -1) {
      id = id.substring(id.lastIndexOf("_") + 1);
    }
    return id;
  }
}

class user_prop {
  uniqueid;
  id;
  firstname;
  lastname;
  email;
}

class tree_node {
  name;
  id;
  parent_id;
  is_filtered = false;
  is_child_displayed = false;
  childs = new Map();
  links = new Map();

  constructor(name, id, parent_id) {
    this.name = name;
    this.id = id + "";
    this.parent_id = parent_id + "";
  }
}

class link_node {
  name;
  id;
  parent_name = null;
  is_filtered = false;

  constructor(name, id, parent_name) {
    this.name = name;
    this.id = id + "";
    this.parent_name = parent_name;
  }
}