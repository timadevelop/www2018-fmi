<?php require("db.php"); ?>
<?php
$id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$trip = R::findOne('trips', 'id = ?', [$id]);

if ( ! $trip ) {
  array_push($_SESSION['messages'], "There is no user with id {$id}");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
$user = R::findOne('users', 'id = ?', array($trip->author_id));
?>
  <?php include_once("parts/header.php") ?>

  <?php if ( ! isset($_SESSION['logged_user']) ) : ?>
  <?php include_once("parts/blocks/propose.php") ?>
  <?php endif; ?>


  <div class="container flex space-between horizontal">
    <div class="flex flex-start vertical flex3">
      <div class="block centerItems trip">
        <h4>
          <?=$trip->title?>
        </h4>
        <hr>
          <div class="flex flex-end horizontal">
            <?php if( isset($_SESSION['logged_user'])): ?>
              <script src="../dist/js/upvote.js"></script>
              <?php if(! in_array($_SESSION['logged_user']->id, json_decode($trip->upvotes ))) : ?>
                <a class="button special" onclick="upvote(event, 'trips', <?=$trip->id?>)"><?=count(json_decode($trip->upvotes))?> | upvote</a>
              <?php else: ?>
                <a class="button" onclick="downvote(event, 'trips', <?=$trip->id?>)"><?=count(json_decode($trip->upvotes))?> | upvoted</a>
              <?php endif; ?>
              <?php if( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $trip->author_id) : ?>
                <a class="button hided warning" href="/action/delete/trip.php/<?=$trip->id?>">remove</a>
              <?php endif; ?>
            <?php endif; ?>
            <a class="button hided" href="/share/trip.php/<?=$trip->id?>">share</a>
            <a class="author flex horizontal" href="/user.php/<?=$user->id?>">
              <div class="flex vertical">
                <img class="authorImg" alt="<?=$user->login?>" src="<?=(isset($user->img_src) && !empty($user->img_src) ? $user->img_src :'/dist/images/logos/glimmerjs.svg')?>" />
                <small><?=$user->login?></small>
              </div>
          </a>
          </div>
        <img src="<?=(isset($trip->img_src) && !empty($trip->img_src) ? $trip->img_src :'/dist/images/logos/glimmerjs.svg')?>" />
        <div class="flex space-between vertical flex3">
          <h5>
            <?=$trip->short_description?>
          </h5>
          <span><?=$trip->date?> | score: <?=$trip->score?></span>
        </div>
        <hr>
        <!-- <p>Description: (You can change it, we store this data to db automatically) -->
        <textarea name="description">this is your description.</textarea>

          <div class="tripNavigation">
            <nav id="trip-tabs" class="flex horizontal space-around">
              <a onclick="changeTab(this, 'modify-trip-scenario')" class="selected">Scenario</a>
              <a onclick="changeTab(this, 'modify-trip-transport')">Transport</a>
              <a onclick="changeTab(this, 'modify-trip-checklist')">Checklist</a>
              <a onclick="changeTab(this, 'modify-trip-services')">Services</a>
              <a onclick="changeTab(this, 'modify-trip-tasks')">Tasks</a>
              <a onclick="changeTab(this, 'modify-trip-travelers')">Travelers</a>
            </nav>

            <div id="fragments">
              <?php include_once("parts/trip_fragments/scenario.php") ?>
              <?php include_once("parts/trip_fragments/transport.php") ?>
              <?php include_once("parts/trip_fragments/checklist.php") ?>
              <?php include_once("parts/trip_fragments/services.php") ?>
              <?php include_once("parts/trip_fragments/tasks.php") ?>
              <?php include_once("parts/trip_fragments/travelers.php") ?>
            </div>
          </div>
      </div>
    </div>
    <div class="flex flex-start vertical flex2">
      <?php include_once("parts/blocks/news.php") ?>
      <?php include_once("parts/blocks/subscribe.php") ?>
      <?php include_once("parts/blocks/facebook.php") ?>
      <?php include_once("parts/foot.php") ?>
    </div>

  </div>


  <script src="../dist/js/trip_navigation.js"></script>
  <?php include_once("parts/footer.php") ?>
