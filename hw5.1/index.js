window.onload = init;

function init() {
  var form = document.getElementById("registration-form");
  var loginInput = document.getElementById("login_input");
  var passwordInput = document.getElementById("password_input");
  var passwordConfirmationInput = document.getElementById("password_confirmation");
  var messageP = document.getElementById("message");

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

  function submitHandler(event) {
    if (checkLogin(event) &&
      checkPassword(event) &&
      checkPasswordConfirm(event)) {
      showSuccess("Yes, send it!");
      return true;
    } else {
      showWarn("Hmm.. there is some error in your form data...");
      event.preventDefault();
      return false;
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



  function isValidLogin(string) {
    return string.length >= 3 && string.length <= 10 && string.match("^[a-zA-Z0-9_]+$");
  }

  function isValidPassword(string) {
    return string.length >= 6 && string.match("[a-z]+") && string.match("[A-Z]+") && string.match("[0-9]+");
  }

  function checkLogin(event) {
    if (!isValidLogin(loginInput.value)) {
      showWarn("Login is not valid:<br>потребителско име - поне 3 символа и най-много 10 символа - букви, цифри и _");
      return false;
    } else {
      hideMsg();
      return true;
    }
  }

  form.addEventListener('submit', submitHandler);
  passwordConfirmationInput.addEventListener('input', checkPasswordConfirm);
  passwordInput.addEventListener('input', checkPassword);
  loginInput.addEventListener('input', checkLogin);
}
