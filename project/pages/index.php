<?php include_once("parts/header.php") ?>

<?php if (session_status() == PHP_SESSION_NONE) : ?>
<?php include_once("parts/blocks/propose.php") ?>
<?php endif; ?>

<div class="container flex space-between horizontal mt30">
  <div class="flex flex-start vertical flex2">
    <?php include_once("parts/blocks/highlights.php") ?>
  </div>
  <div class="flex flex-start vertical flex1">
    <?php include_once("parts/blocks/news.php") ?>
    <?php include_once("parts/blocks/subscribe.php") ?>
    <?php include_once("parts/blocks/facebook.php") ?>

  </div>

</div>

<?php include_once("parts/footer.php") ?>
