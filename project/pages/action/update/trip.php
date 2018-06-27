<?php require(__DIR__."/../../db.php"); ?>
<?php

$url = $_SERVER['REQUEST_URI'];
// print_r($url);
$query_str = parse_url($url, PHP_URL_QUERY);
parse_str($query_str, $query_params);
// print_r($query_params);
$action = $query_params['action'];

$id = $query_params['id'];
$trip = R::findOne('trips', 'id = ?', array($id));

header('Content-type: application/json');


if ( $trip && $action == 'upvote' ) {
  $newUpvotes = json_decode($trip->upvotes);
  $uid = intval($_SESSION['logged_user']->id);
  if(! in_array($uid,$newUpvotes ))
  {
    $newUpvotes[] = $_SESSION['logged_user']->id;
    $trip->upvotes = json_encode($newUpvotes);
    R::store($trip);
  }
  echo json_encode($trip->upvotes);
}
if ( $trip && $action == 'downvote' ) {
  $newUpvotes = json_decode($trip->upvotes);
  $uid = intval($_SESSION['logged_user']->id);
  if( in_array($uid,$newUpvotes ))
  {
    $newUpvotes = array_diff($newUpvotes, array($_SESSION['logged_user']->id));
    $trip->upvotes = json_encode($newUpvotes);
    R::store($trip);
  }
  echo json_encode($trip->upvotes);
}
//
// $trip = R::dispense('trips');
//
// $trip->title = $title;
// $trip->img_src = $img_src;
// $trip->is_public = $public;
// $trip->date = $date;
//
// $trip = R::dispense('trips');
//
// $trip->title = $title;
// $trip->img_src = $img_src;
// $trip->is_public = $public;
// $trip->date = $date;
// $trip->score = 0;
//
// $trip->scenario = json_encode(["Sofia", "London"]);
// $trip->transport = "own";
// $trip->checklist = json_encode(["Checklist item"]);
// $trip->tasks = json_encode(["Temporary task"]);
// $trip->travelers = json_encode([$_SESSION['logged_user']->id]);
// $trip->services = json_encode(array());
//
// $trip->short_description = $short_description;
// $trip->description = $short_description . ' Change this description.';
//

?>
