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
else if ( $trip && $action == 'downvote' ) {
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
else if ( $trip && $action == 'changeTasks' && isset($query_params['tasks'])) {
  // print_r($query_params['tasks']);
  // print_r(json_decode($query_params['tasks']));
  $trip->tasks = $query_params['tasks'];
  R::store($trip);
  echo json_encode('Ok');
}
else if ( $trip && $action == 'addTraveler' && isset($query_params['login'])) {
  // print_r($query_params['tasks']);
  // print_r(json_decode($query_params['tasks']));
  $new_traveler = R::findOne('users', 'login= ?', [$query_params['login']]);
  if ( ! $new_traveler ) {
    echo json_encode('No such user');
    return;
  }
  $result_list = json_decode($trip->travelers);
  if( in_array($new_traveler->id, $result_list) ) {
    echo json_encode('Already in trip!');
    return;
  }

  $result_list[] = $new_traveler->id;
  $trip->travelers = json_encode($result_list);
  R::store($trip);
  echo json_encode('Ok');
}
else if ( $trip && $action == 'rmTraveler' && isset($query_params['userId'])) {
  // print_r($query_params['tasks']);
  // print_r(json_decode($query_params['tasks']));
  // $new_traveler = R::findOne('users', 'id = ?', [$query_params['id']]);
  // if ( ! $new_traveler ) {
  //   echo json_encode('No such user');
  //   return;
  // }
  $result_list = json_decode($trip->travelers);
  // if( in_array($query_params['userId'], $result_list) ) {
    // echo($result_list);
    // echo json_encode('Already in trip!' . $query_params['id']);
    // $result_list = array_diff($result_list, [$query_params['id']]);
    if (($key = array_search($query_params['userId'], $result_list)) !== false) {
    unset($result_list[$key]);
    // unset($result_list[$query_params['userId']]);
    $trip->travelers = json_encode(array_values($result_list));
    R::store($trip);
    echo json_encode('Ok');
    return;
  }
  echo json_encode('No such user in trip');
}
else {
  //
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
