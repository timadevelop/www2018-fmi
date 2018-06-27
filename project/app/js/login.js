import { ajax, createElementFromHTML } from './functions';

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
