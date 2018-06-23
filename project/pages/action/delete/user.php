<?php require(__DIR__."/../../db.php"); ?>
<?php
if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_user']) ) {
  array_push($_SESSION['messages'], 'Login, please.');
  redirect('login.php');
}
if ( isset($_SESSION['logged_user']->services)) {
  array_push($_SESSION['messages'], 'As company you cannot delete users.');
  redirect($_SERVER['HTTP_REFERER']);
}

$id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$user = R::findOne('users', 'id = ?', [$id]);

if ( ! $user ) {
  array_push($_SESSION['messages'], "There is no user with id {$id}");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}

if( $_SESSION['logged_user']->id == $user->id || $_SESSION['logged_user']->login == 'root') {
  R::trash($user);
  array_push($_SESSION['messages'], "user {$user->login} is deleted successfully.");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
else {
  array_push($_SESSION['messages'], 'You can delete only your users');
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
?>