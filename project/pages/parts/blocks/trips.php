<?php
  // $trips = R::find('trips', '', []);
  $page=1;
  $limit=10;
  $trips=R::findAll('trips', 'ORDER BY created_at LIMIT ?,? ',array((($page-1)*$limit),$limit));
?>
<div class="block">
  <h4>Last trips</h4>
  <hr>
  <ul class="items" id="tripsList">
    <?php foreach ($trips as $trip): ?>
      <?php include($_SERVER["DOCUMENT_ROOT"].'/parts/trip.php') ?>
    <?php endforeach; ?>
  </ul>
    <div class="mt30 flex space-around horizontal">
      <a onclick="showmore(event)">Show more</a>
    </div>
</div>
<script src="../dist/js/showmore.js"></script>
