<div class="block">
  <h4>Last users</h4>
  <hr>
  <ul class="items">
<?php
  $users = R::find('users', '', []);
?>
    <?php foreach ($users as $user): ?>
      <?php include($_SERVER["DOCUMENT_ROOT"].'/parts/user.php') ?>
    <?php endforeach; ?>
    <div class="flex space-around horizontal">
      <a href="/">Show more</a>
    </div>
  </ul>
</div>
