<?php require(__DIR__."/../../db.php"); ?>
<?php
if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_user']) ) {
  array_push($_SESSION['messages'], 'Login, please.');
  redirect('login.php');
}
if ( isset($_SESSION['logged_user']->services)) {
  array_push($_SESSION['messages'], 'As company you can delete services, not trips.');
  redirect($_SERVER['HTTP_REFERER']);
}

$id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$trip = R::findOne('trips', 'id = ?', [$id]);

if ( ! $trip ) {
  array_push($_SESSION['messages'], "There is no trip with id {$id}");
  redirect($_SERVER['HTTP_REFERER']);
}

if( $_SESSION['logged_user']->id == $trip->author_id || $_SESSION['logged_user']->login == 'root') {
  R::trash($trip);
  array_push($_SESSION['messages'], "Trip {$trip->title} is deleted successfully.");
  redirect($_SERVER['HTTP_REFERER']);
}
else {
  array_push($_SESSION['messages'], 'You can delete only your trips');
  redirect($_SERVER['HTTP_REFERER']);
}
?>
