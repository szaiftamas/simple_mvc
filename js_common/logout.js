/* global failureHandler */

var logout_confirm_button_el = document.getElementById("logout_confirm_button");

if (logout_confirm_button_el !== null) {
  logout_confirm_button_el.addEventListener("click", () => {
    var obj = new Object();
    obj.controller = "PageController";
    obj.methode = "logout";
    obj.username = sessionStorage.getItem('userId');
    callXHttp("index.php", "POST", obj, null, successLogoutHandler, failureHandler);
  });
}

function successLogoutHandler() {
  sessionStorage.removeItem('userId');
  sessionStorage.removeItem('userName');
  sessionStorage.removeItem('user_access');
  window.location.href = "index.php";
}
