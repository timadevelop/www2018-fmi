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
  echo 'here';
  $errors = array();
  if( trim($_POST['email']) == '' )
  {
    $errors[] = 'login is not valid';
  }

  if( empty($errors) )
  {
    if( R::count('users', 'email = ?', array($_POST['email'])) > 0 )
    {
      login();
    }
    else
    {
      $user = R::dispense('users');
      $user->email = $_POST['email'];
      $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      R::store($user);
      login();
      echo "OK, you're registered.";
    }
  }
  else
  {
    echo 'werrrrs';
    print_r($errors);
  }

?>

<?php else: ?>

<?php include_once("parts/header.php") ?>
<div class="mt30 block container">
  <?php if ( isset($_SESSION['messages']) ) : ?>
    <div class="block">
      <div class="flex space-between horizontal">
        <?php foreach ($_SESSION['messages'] as $msg): ?>
        <h1>
          <?=$msg?> </h1>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <form action="login.php" method="POST" class="ui-form flex space-around vertical">
    <p>Nomadplan strive to facilitate the planning and management of travel.</p>
    <!-- <p><b>Log in</b> to try features we provide.</p> -->
    <input type="email" name="email" required autocomplete="off" placeholder="Your email" value="<?php echo @$data['login']; ?>">
    <input type="password" name="password" id="password" required placeholder="Your password" autocomplete="off">
    <button class="button" name="login" type="submit">Log in</button>
    <a href="me.html" class="button" id="google-login">Login using google</a>
    <a href="me.html" class="button" id="fb-login">Login using Facebook</a>
    <a href="login_company.html" class="button" id="company-login">I represent a company</a>
    <span>We'll never spanost to any of your accounts without your spanermission.</span>
  </form>
</div>
<?php include_once("parts/footer.php") ?>
<?php endif; ?>
