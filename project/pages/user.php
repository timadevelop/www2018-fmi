<?php require("db.php"); ?>
<?php
if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_user']) ) {
  array_push($_SESSION['messages'], 'Login, please.');
  redirect('../login.php');
}
$id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$user = R::findOne('users', 'id = ?', [$id]);

if ( ! $user ) {
  array_push($_SESSION['messages'], "There is no user with id {$id}");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
?>
  <?php include_once("parts/header.php") ?>

  <?php if ( ! isset($_SESSION['logged_user']) ) : ?>
  <?php include_once("parts/blocks/propose.php") ?>
  <?php endif; ?>


  <div class="container flex space-between horizontal">
    <div class="flex flex-start vertical flex3">
      <div class="block centerItems user">
        <h4>
          Awesome user
        </h4>
        <hr>
        <img src="<?=(isset($user->img_src) && !empty($user->img_src) ? $user->img_src :'https://cdn.svgporn.com/logos/glimmerjs.svg')?>" />
        <div class="flex space-between vertical flex3">
          <h4>
            <?=$user->login?>
          </h4>
          <span><?=$user->email?></span>
          <div class="flex center-content horizontal">
            <?php if( isset($_SESSION['logged_user']) &&
                  ( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $user->id)) : ?>
            <a class="button hided warning" href="action/delete/user.php/<?=$user->id?>">remove</a>
            <?php endif; ?>
            <a class="button hided" href="share.php/user/<?=$user->id?>">share</a>
            <a class="button" href="user.php/<?=$user->id?>">more</a>
          </div>
        </div>
      </div>

    <div class="block">
      <h4><?=$user->login?>'s trips</h4>
        <hr>
        <ul class="items">
      <?php
        $trips = R::find('trips', 'author_id = ?', [$user->id]);
      ?>
          <?php foreach ($trips as $trip): ?>
            <?php include('parts/trip.php') ?>
          <?php endforeach; ?>
          <div class="flex space-around horizontal">
            <a href="">Show more</a>
          </div>
        </ul>
      </div>
    </div>
    <div class="flex flex-start vertical flex2">
      <?php include_once("parts/blocks/news.php") ?>
      <?php include_once("parts/blocks/subscribe.php") ?>
      <?php include_once("parts/blocks/facebook.php") ?>
      <?php include_once("parts/foot.php") ?>
    </div>

  </div>

  <?php include_once("parts/footer.php") ?>
