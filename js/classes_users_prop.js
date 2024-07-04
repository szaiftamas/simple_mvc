
class users_prop {

  users_prop = new Map();

  constructor(users_prop) {
    users_prop.forEach((value) => {
      this.users_prop.set(this.reduce_id(value.id), value);
    });
  }

  get_user_prop(id) {
    return this.users_prop.get(this.reduce_id(id));
  }

  set_inactive_background() {
    this.users_prop.forEach((user_prop) => {
      const el = document.getElementById("us_li_" + user_prop.id);
      if (el !== null && el !== 'undefined') {
        if ((user_prop.isactive + "") === "0") {
          el.classList.add("bg-secondary");
        } else {
          el.classList.remove("bg-secondary");
        }
      }
    });
  }

  update_user_prop(obj) {
    const user_prop = this.users_prop.get(obj.row_id);
    user_prop.email = obj.user_email;
    user_prop.firstname = obj.user_first_name;
    user_prop.isactive = obj.user_modal_active;
    user_prop.lastname = obj.user_last_name;
    user_prop.uniqueid = obj.user_uniqueid;
    user_prop.language = obj.user_language;

  }

  add_user(obj) {
    const user_prop = new Object();
    user_prop.id = obj.row_id;
    user_prop.email = obj.user_email;
    user_prop.firstname = obj.user_first_name;
    user_prop.isactive = obj.user_modal_active;
    user_prop.lastname = obj.user_last_name;
    user_prop.uniqueid = obj.user_uniqueid;
    user_prop.language = obj.user_language;
    this.users_prop.set(obj.row_id, user_prop);
  }

  reduce_id(id) {
    id = id + "";
    if (id.indexOf("_") !== -1) {
      id = id.substring(id.lastIndexOf("_") + 1);
    }
    return id;
  }
}