<div class="block">
  <h4>Last services</h4>
  <hr>
  <ul class="items">
<?php
  $services = R::find('services', '', []);
?>
    <?php foreach ($services as $service): ?>
      <?php include($_SERVER["DOCUMENT_ROOT"].'/parts/service.php') ?>
    <?php endforeach; ?>
    <div class="flex space-around horizontal">
      <a href="/">Show more</a>
    </div>
  </ul>
</div>
