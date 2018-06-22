<?php include_once("parts/header.php") ?>

<?php if ( ! isset($_SESSION['logged_user']) ) : ?>
<?php include_once("parts/blocks/propose.php") ?>
<?php endif; ?>


<div class="container flex space-between horizontal">
  <div class="flex flex-start vertical flex3">
    <?php include_once("parts/blocks/trips.php") ?>
  </div>
  <div class="flex flex-start vertical flex2">
    <?php include_once("parts/blocks/news.php") ?>
    <?php include_once("parts/blocks/subscribe.php") ?>
    <?php include_once("parts/blocks/facebook.php") ?>
    <?php include_once("parts/foot.php") ?>
  </div>

</div>

<?php include_once("parts/footer.php") ?>
