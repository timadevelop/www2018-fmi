// Ajax stuff
function ajax(url, settings) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (xhr.status == 200) {
      settings.success(xhr.responseText);
    } else {
      console.error(xhr.responseText);
    }
  };
  xhr.open(settings.method || 'GET', url, /* async */ true);
  xhr.send(settings.data || null);
}
//
// ajax callback
//
const loginInput = document.getElementById('loginInput');
const pwdInput = document.getElementById('passwordInput');
const emailInput = document.getElementById('emailInput');
const notifications = document.getElementById('notifications');

let callback = function(text) {
  let json = JSON.parse(text);
  if (json === null) {
    emailInput.required = true;
    emailInput.style.display = 'block';
  }
  else {
    loginInput.style.border = '1px solid #00b27f';
    emailInput.required = false;
    emailInput.style.display = 'none';
  }
};

function get_user(login) {
  ajax('/action/find/user.php/' + login, {
    success: callback,
    method: 'GET'
  });
}

window.onLoginInputChange = function (e) {
  get_user(e.target.value);
}
