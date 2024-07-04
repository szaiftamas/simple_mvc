/* global failureHandler */
/* global mdb */
/* global trl */

var password_show_hide_span_el = document.getElementById("password_show_hide_span");
var chgpsw_confirm_button_el = document.getElementById("chgpsw_confirm_button");

if (chgpsw_confirm_button_el !== null) {
  chgpsw_confirm_button_el.addEventListener("click", (evt) => {
    var obj = new Object();
    obj.function = "chgpsw";
    obj.old_psw = document.getElementById("old_psw").value;
    obj.new_psw = document.getElementById("new_psw").value;
    if (validatePassword(obj.new_psw)) {
      callXHttp("_common/chgpsw", "POST", obj, null, successChgPswHandler, failureHandler);
    } else {
      showToast("Warning", trl.dict("The new password is not enough strong!"));
    }
  });
}

function successChgPswHandler(resp) {
  document.getElementById("old_psw").value = "";
  document.getElementById("new_psw").value = "";
  sessionStorage.setItem('pw_warning', "false");
  var myModalEl = document.getElementById('chgpswModal');
  var modal = mdb.Modal.getInstance(myModalEl); // Returns a Bootstrap modal instance
  modal.hide();
  showToast("Success", trl.dict("Password successfully changed!"));
}

if (password_show_hide_span_el !== null) {
  password_show_hide_span_el.addEventListener("click", (evt) => {
    var x = document.getElementById("new_psw");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    if (x.type === "password") {
      x.type = "text";
      show_eye.style.display = "none";
      hide_eye.style.display = "block";
    } else {
      x.type = "password";
      show_eye.style.display = "block";
      hide_eye.style.display = "none";
    }
  });
}

function validatePassword(password) {
  const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
  return password.match(pattern);
}