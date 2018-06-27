<?php
require("db.php");
if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_user']) ) {
  array_push($_SESSION['messages'], 'To create your next plan, login please.');
  redirect('login.php');
}
if ( isset($_SESSION['logged_user']->services)) {
  array_push($_SESSION['messages'], 'As company you cannot create trips, try add some service');
  redirect('newservice.php');
}
?>

<?php if( isset($_POST['submit_public']) || isset($_POST['submit_private']) ) : ?>
<?php
//$trip = R::findOne('trips', 'email = ?', array($_POST['email']));
// create new;
$title = trim($_POST['title']);
$img_src = isset($_POST['img_src']) ? trim($_POST['img_src']) : '';
$public = isset($_POST['submit_public']) ? true : false;
$date = trim($_POST['date']);
$short_description = trim($_POST['short_description']);

if( empty($img_src) )
{
  $img_src = 'https://cdn.svgporn.com/logos/gusto.svg';
}
if( $title == '' || $date == '' || $short_description == '')
{
  array_push($_SESSION['messages'], 'Bad format');
  redirect('/new');
}

$trip = R::dispense('trips');

$trip->title = $title;
$trip->img_src = $img_src;
$trip->is_public = $public;
$trip->date = $date;
$trip->score = 0;

$trip->scenario = json_encode(["Sofia", "London"]);
$trip->transport = "own";
$trip->checklist = json_encode(["Checklist item"]);
$trip->tasks = json_encode(["Temporary task"]);
$trip->travelers = json_encode([$_SESSION['logged_user']->id]);
$trip->services = json_encode(array());

$trip->short_description = $short_description;
$trip->description = $short_description . ' Change this description.';
$trip->author_id = $_SESSION['logged_user']->id;
$trip->created_at = date('l jS \of F Y h:i:s A');

R::store($trip);
redirect('index.php');
?>

    <?php else: ?>

    <?php include_once("parts/header.php") ?>

    <script src="../libs/js/dropzone/dropzone.js"></script>
    <link rel="stylesheet" href="../libs/js/dropzone/dropzone.css">

    <div class="mt30 block container">
      <?php include("parts/messages.php") ?>
      <!-- <form action="/upload&#45;target" class="dropzone"></form> -->
      <form action="/new.php" method="POST" id="newTripForm" autocomplete="off" class="newForm flex space-around vertical">
        <h3>Add new trip</h3>
        <div class="form-row flex space-between">
          <lable class="flex1" for="title">Title</lable>
          <input class="flex4" type="text" name="title" required minlength="4" maxlength="30" placeholder="Trip title" value="<?php echo @$data['title']; ?>">
          </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="short_description">Short description</lable>
          <input class="flex4" type="text" name="short_description" required minlength="4" maxlength="50" placeholder="Short description" value="<?php echo @$data['title']; ?>">
        </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="date">Date</lable>
          <input class="flex4" type="date" name="date" required>
        </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="img_src">Image link</lable>
          <input class="flex4" type="text" name="img_src" placeholder="https://raw.some.com/image.png">
          </div>
        <div class="form-row flex space-between unavailable">
          <lable class="flex1" for="next_features">More properties coming soon...</lable>
        </div>
        <div class="form-row flex space-between">
          <a class="button" href="/index">Cancel</a>
          <div class="form-row flex flex-end">
            <button class="button special" name="submit_private" type="submit">Create private</button>
            <button class="button" name="submit_public" type="submit">Create public</button>
          </div>
        </div>
      </form>
    </div>
    <?php include_once("parts/footer.php") ?>
    <?php endif; ?>
