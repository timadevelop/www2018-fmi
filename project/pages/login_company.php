<?php
require("db.php");
if ( isset($_SESSION['logged_company']) ) {
  array_push($_SESSION['messages'], 'Already logged in');
  redirect('index.php');
}
?>

<?php if( isset($_POST['email']) ) : ?>
<?php
function login() {
  $company = R::findOne('companies', 'email = ?', array($_POST['email']));
  if ( ! $company )
  {
    $company = R::findOne('companies', 'login = ?', array($_POST['login']));
  }
  if ( $company )
  {
    if( password_verify($_POST['password'], $company->password) )
    {
      $_SESSION['logged_user'] = $company;
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
    if( R::count('companies', 'email = ?', array($_POST['email'])) > 0 ||  R::count('companies', 'login = ?', array($_POST['login'])) > 0  )
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
        $img_src = '/dist/images/logos/groovehq.svg';
      }
      $company = R::dispense('companies');
      $company->login = trim($_POST['login']);
      $company->name = trim($_POST['name']);
      $company->email = trim($_POST['email']);
      $company->services= trim($_POST['services']);
      $company->img_src = $img_src;
      $company->score = 0;
      $company->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      R::store($company);
      login();
    }
  }
?>

<?php else: ?>

<?php include_once("parts/header.php") ?>
<div class="mt30 block container">
  <?php include "parts/messages.php" ?>
  <form action="/login_company.php" method="POST" class="ui-form flex space-around vertical centerItems">
    <img style="width:120px;height:111px;" src="/dist/images/logos/nomad.svg" />
    <p>Nomadplan strive to facilitate the planning and management of travel. And you can help us providing your services and gaining new clients.</p>
    <input type="text" name="login" required minlength="4" maxlength="50" placeholder="Company login" value="<?php echo @$company->login; ?>">
    <input type="text" name="name" required minlength="2" maxlength="50" placeholder="Company name" value="<?php echo @$company->name; ?>">
    <input type="password" name="password" minlength="4" id="password" required placeholder="Company password" autocomplete="off">
    <input type="email" name="email" placeholder="Company email" value="">
    <input type="text" name="services" minlength="4" placeholder="Type of services" value="">
    <button class="button" name="login_action" type="submit">Submit</button>
    <span>We'll never spanost to any of your accounts without your spanermission.</span>
  </form>
</div>
<?php include_once("parts/footer.php") ?>
<?php endif; ?>
