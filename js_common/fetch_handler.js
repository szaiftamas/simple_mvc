
async function fetch_handler(url, obj) {
  const response = await fetch(url, {method: "POST", headers: {"Content-Type": "application/x-www-form-urlencoded"}, body: Object.keys(obj).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(obj[key])).join('&')});

  if (response.status === 200) {
    const resp = await response.json();
    if (resp["success"]) {
      return resp;
    } else {
      showToast("Warning", resp["message"]);
    }
  } else {
    showToast("Warning", "HTTP Error: " + response.status);
  }
  return new Object();
}


