<div class="block">
  <h4>Last trips</h4>
  <hr>
  <ul class="items">
<?php
  $trips = R::find('trips', '', []);
?>
    <?php foreach ($trips as $trip): ?>
      <?php include($_SERVER["DOCUMENT_ROOT"].'/parts/trip.php') ?>
    <?php endforeach; ?>
    <div class="flex space-around horizontal">
      <a href="/">Show more</a>
    </div>
  </ul>
</div>
