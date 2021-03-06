<?php
require("db.php");
if ( isset($_SESSION['logged_user']) ) {
  array_push($_SESSION['messages'], 'Already logged in');
  redirect('index.php');
}
?>

<?php if( isset($_POST['email']) ) : ?>
<?php
function login() {
  $user = R::findOne('users', 'email = ?', array($_POST['email']));
  if ( ! $user )
  {
    $user = R::findOne('users', 'login = ?', array($_POST['login']));
  }
  if ( $user )
  {
    if( password_verify($_POST['password'], $user->password) )
    {
      $_SESSION['logged_user'] = $user;
      redirect('index.php');
    }
    else {
      array_push($_SESSION['messages'], 'Wrong password');
      redirect('login.php');
    }
  }
  else {
    array_push($_SESSION['messages'], 'Sorry, something is wrong... we will fix this as soon as possible. ');
    redirect('login.php');
  }
}
  // register;
  if( ! isset($_POST['login']) ||  trim($_POST['login']) == '' )
  {
    array_push($_SESSION['messages'], 'Login is not valid');
    redirect('login.php');
  }

  if( empty($errors) )
  {
    if( R::count('users', 'email = ?', array($_POST['email'])) > 0 ||  R::count('users', 'login = ?', array($_POST['login'])) > 0  )
    {
      login();
    }
    else
    {
      if( trim($_POST['email']) == '' )
      {
        array_push($_SESSION['messages'], 'Login '.$_POST['login'].' is not registered. To register new account you need to specify your email address.');
        redirect('login.php');
      }
      $img_src= trim($_POST['img_src']);
      if ( empty($img_src) ) {
        $img_src = '/dist/images/logos/bigpanda.svg';
      }
      $user = R::dispense('users');
      $user->login = trim($_POST['login']);
      $user->email = trim($_POST['email']);
      $user->img_src = $img_src;
      $user->score = 0;
      $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      R::store($user);
      login();
    }
  }
?>

<?php else: ?>

<?php include_once("parts/header.php") ?>
<div class="mt30 block container">
  <?php include "parts/messages.php" ?>
  <form action="/login.php" method="POST" class="ui-form flex space-around vertical centerItems">
    <img style="width:120px;height:111px;" src="/dist/images/logos/nomad.svg" />
    <p>Nomadplan strive to facilitate the planning and management of travel.</p>
    <!-- <p><b>Log in</b> to try features we provide.</p> -->
    <input id="loginInput" onchange="onLoginInputChange(event)" type="text" name="login" required minlength="4" maxlength="50" placeholder="Your login" value="<?php echo @$user->login; ?>">
    <input id="passwordInput" type="password" name="password" minlength="4" id="password" required placeholder="Your password" autocomplete="off">
    <input id="emailInput" type="email" name="email" placeholder="Your email except you are loginning in" value="<?php echo @$user->email; ?>">
    <button class="button" name="login_action" type="submit">Log in</button>
    <a href="/me.html" class="button" id="google-login">Login using google</a>
    <a href="/me.html" class="button" id="fb-login">Login using Facebook</a>
    <a href="/login_company" class="button" id="company-login">I represent a company</a>
    <span>We'll never spanost to any of your accounts without your spanermission.</span>
  </form>
</div>
  <script src="../dist/js/login.js"></script>
<?php include_once("parts/footer.php") ?>
<?php endif; ?>
