<div class="block">
  <h4>Last companies</h4>
  <hr>
  <ul class="items">
<?php
  $companies = R::find('companies', '', []);
?>
    <?php foreach ($companies as $company): ?>
      <?php include('parts/company.php') ?>
    <?php endforeach; ?>
    <div class="flex space-around horizontal">
      <a href="">Show more</a>
    </div>
  </ul>
</div>
