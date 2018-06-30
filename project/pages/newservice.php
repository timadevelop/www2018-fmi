<?php
require("db.php");
if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_user']) || !isset($_SESSION['logged_user']->services)) {
  array_push($_SESSION['messages'], 'To create your next plan, login please.');
  redirect('login.php');
}
?>

<?php if( isset($_POST['submit_public']) || isset($_POST['submit_private']) ) : ?>
<?php
//$service = R::findOne('services', 'email = ?', array($_POST['email']));
// create new;
$title = trim($_POST['title']);
$price = trim($_POST['price']);
$img_src = isset($_POST['img_src']) ? trim($_POST['img_src']) : '';
$location = trim($_POST['location']);
$short_description = trim($_POST['short_description']);

if( empty($img_src) )
{
  $img_src = '/dist/images/logos/gusto.svg';
}
if( $price == '' || $title == '' || $short_description == '')
{
  array_push($_SESSION['messages'], 'Bad format');
  $data = array(
    'title' => $title,
    'short_description' => $short_description,
    'price' => $price,
    'img_src' => $img_src,
    'location' => $location,
  );
  redirect('/newservice');
}

$service = R::dispense('services');

$service->title = $title;
$service->price = $price;
$service->img_src = $img_src;
$service->location = $location;
$service->score = 0;
$service->short_description = $short_description;
$service->company_id = $_SESSION['logged_user']->id;
$service->created_at = date('l jS \of F Y h:i:s A');

R::store($service);
redirect('services.php');

?>

    <?php else: ?>

    <?php include_once("parts/header.php") ?>

    <script src="../libs/js/dropzone/dropzone.js"></script>
    <link rel="stylesheet" href="../libs/js/dropzone/dropzone.css">

    <div class="mt30 block container">
      <?php include("parts/messages.php") ?>
      <!-- <form action="/upload&#45;target" class="dropzone"></form> -->
      <form action="/newservice.php" method="POST" id="newserviceForm" autocomplete="off" class="newForm flex space-around vertical">
      <h3>Add new service as <?=$_SESSION['logged_user']->name?></h3>
        <div class="form-row flex space-between">
          <lable class="flex1" for="title">Title</lable>
          <input class="flex4" type="text" name="title" required minlength="4" maxlength="30" placeholder="service title" value="<?php echo @$data['title']; ?>">
          </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="short_description">Short description</lable>
          <input class="flex4" type="text" name="short_description" required minlength="4" maxlength="50" placeholder="Short description" value="<?php echo @$data['short_description']; ?>">
        </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="location">Location</lable>
          <input class="flex4" type="text" name="location" placeholder="Places where your company can provide such service (i.e. worldwide)" value="<?php echo @$data['location']; ?>">
        </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="price">Price</lable>
          <input class="flex4" type="text" name="price" required placeholder="Price" value="<?=@$data['price']?>">
        </div>
        <div class="form-row flex space-between">
          <lable class="flex1" for="img_src">Image link</lable>
          <input class="flex4" type="text" name="img_src" placeholder="https://raw.some.com/image.png" value="<?=@$data['img_src']?>">
        </div>
        <div class="form-row flex space-between unavailable">
          <lable class="flex1" for="next_features">More properties coming soon...</lable>
        </div>
        <div class="form-row flex space-between">
          <a class="button" href="/index">Cancel</a>
          <div class="form-row flex flex-end">
            <button class="button special" name="submit_public" type="submit">Add</button>
          </div>
        </div>
      </form>
    </div>
    <?php include_once("parts/footer.php") ?>
    <?php endif; ?>
