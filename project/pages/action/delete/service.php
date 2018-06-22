<?php require(__DIR__."/../../db.php"); ?>
<?php
if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_user']) ) {
  array_push($_SESSION['messages'], 'Login, please.');
  redirect('login.php');
}
if ( ! isset($_SESSION['logged_user']->services)) {
  array_push($_SESSION['messages'], 'Only companies can delete their services.');
  redirect($_SERVER['HTTP_REFERER']);
}

$id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$service = R::findOne('services', 'id = ?', [$id]);

if ( ! $service ) {
  array_push($_SESSION['messages'], "There is no service with id {$id}");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}

if( $_SESSION['logged_user']->id == $service->company_id || $_SESSION['logged_user']->login == 'root') {
  R::trash($service);
  array_push($_SESSION['messages'], "service {$service->title} is deleted successfully.");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
else {
  array_push($_SESSION['messages'], 'You can delete only your services');
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
?>
