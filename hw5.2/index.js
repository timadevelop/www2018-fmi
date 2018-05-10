window.onload = init;

function init() {
  //
  // Get references to DOM elements
  //
  var form = document.getElementById("registration-form");
  var loginInput = document.getElementById("login_input");
  var passwordInput = document.getElementById("password_input");
  var passwordConfirmationInput = document.getElementById("password_confirmation");
  var messageP = document.getElementById("message");
  var submitButton = document.getElementById("submit-button");

  //
  // Ajax stuff
  //
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
  var callback = function(text) {
    // console.log(text);
    showRegistered(JSON.parse(text));
  };

  function send_to_php(json) {
    // console.log(json);
    ajax('register.php', {
      success: callback,
      method: 'POST',
      data: JSON.stringify(json)
    });
  }


  //
  // UI functions
  //
  function showWarn(string) {
    messageP.classList.remove("success", "hide");
    messageP.classList.add("warn", "show");
    messageP.innerHTML = string;
  }

  function showSuccess(string) {
    messageP.classList.remove("warn", "hide");
    messageP.classList.add("success", "show");
    messageP.innerHTML = string;
  }

  function hideMsg() {
    messageP.classList.remove("show", "warn", "success");
    messageP.classList.add("hide");
  }

  function showRegistered(response) {
    messageP.classList.remove("warn", "hide");
    messageP.classList.add("success", "show");
    submitButton.style.display = 'none';
    var nodes = document.getElementsByTagName("input"); //.forEach(e => e.style.display = 'none');
    for(i = 0; i < nodes.length; i++)
    {
      nodes[i].style.display = 'none';
    }
    messageP.innerHTML = "Hello, " + response.username + "!<br>Logged in successfully";
  }


  //
  // Validators
  //
  function isValidLogin(string) {
    return string.length >= 3 && string.length <= 10 && string.match("^[a-zA-Z0-9_]+$");
  }

  function isValidPassword(string) {
    return string.length >= 6 && string.match("[a-z]+") && string.match("[A-Z]+") && string.match("[0-9]+");
  }

  //
  // Check inputs
  //
  function checkLogin(event) {
    if (!isValidLogin(loginInput.value)) {
      showWarn("Login is not valid:<br>потребителско име - поне 3 символа и най-много 10 символа - букви, цифри и _");
      return false;
    } else {
      hideMsg();
      return true;
    }
  }

  function checkPassword(event) {
    var pswValue = passwordInput.value.trim();
    if (!isValidPassword(pswValue)) {
      showWarn("Password is not valid:<br>парола - поне 6 символа, като трябва да има поне 1 главна, 1 малка буква и 1 цифра")
      return false;
    } else {
      hideMsg();
      return true;

    }
  }

  function checkPasswordConfirm(event) {
    var pswValue = passwordInput.value.trim();
    var confValue = passwordConfirmationInput.value.trim();
    if (pswValue === '' && confValue === '') {
      hideMsg();
      return false;
    }

    if (pswValue === confValue) {
      showSuccess("Passwords are the same :)");
      return true;
    } else {
      showWarn("Passwords are different");
      return false;
    }
  }

  // submit form
  function submitHandler(event) {
    if (checkLogin(event) && checkPassword(event) && checkPasswordConfirm(event)) {
      showSuccess("Yes, send it!");
      send_to_php({
        "username": loginInput.value,
        "password": passwordConfirmationInput.value
      });
      event.preventDefault();
      return false;
    } else {
      showWarn("Hmm.. there is some error in your form data...");
      event.preventDefault();
      return false;
    }
  }

  //
  // Add event listeners
  //
  form.addEventListener('submit', submitHandler);
  passwordConfirmationInput.addEventListener('input', checkPasswordConfirm);
  passwordInput.addEventListener('input', checkPassword);
  loginInput.addEventListener('input', checkLogin);
}
