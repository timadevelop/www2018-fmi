<div class="hidden" id="modify-trip-services">
  <ul class="items" id="trip_services_list">
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
