
<div class="hidden" id="modify-trip-travelers">
  <p>These people are your team for this trip!</p>
    <ul class="items">
    <?php foreach (json_decode($trip->travelers) as $userId): ?>
      <?php
        $user = R::findOne('users', 'id = ?', [$userId]);
        if( ! $user ) {
          echo "No such user";
        } else {
          include($_SERVER["DOCUMENT_ROOT"].'/parts/user.php');
        }
      ?>
    <?php endforeach; ?>
    <div class="flex space-around horizontal">
      <a href="/">Show more</a>
    </div>
  </ul>
</div>
