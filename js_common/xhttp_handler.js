
function callXHttp(target, methods, obj, requiredKeys, successHandler, failureHandler, async = true, isJSON = true, restore = true) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (this.status === 200) {
        try {
          var resp = this.responseText;
          if (isJSON) {
            resp = JSON.parse(this.responseText);
            if (requiredKeys !== null) {
              Object.keys(requiredKeys).forEach(function (key) {
                if (!(requiredKeys[key] in resp)) {
                  throw requiredKeys[key] + " undefined!";
                }
              });
            }
          }
          if (obj.hasOwnProperty('parameter')) {
            successHandler(resp, obj.parameter);
          } else {
            successHandler(resp);
          }
        } catch (err) {
          failureHandler(err);
        }
      } else if (failureHandler !== null) {
        failureHandler(this.responseText);
      }

    }
  };
  var url = 'index.php';
  xhttp.open(methods, url, async);
  if (methods === "POST") {
    const formBody = Object.keys(obj).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(obj[key])).join('&');
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send(formBody);
  }
}

function json_replacer(key, value) {
  if (value instanceof Map) {
    return  Array.from(value.entries());
  } else {
    return value;
  }
}