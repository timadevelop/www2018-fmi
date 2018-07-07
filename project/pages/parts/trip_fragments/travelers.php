
<div class="hidden" id="modify-trip-travelers">
  <p>These people are your team for this trip!</p>
    <div class="flex center-content horizontal">
      <input onkeypress="if (event.keyCode == 13) addTraveler(event, 'newUserInput', <?=$trip->id?>)" id="newUserInput" class="flex4" type="text" />
      <button onclick="addTraveler(event, 'newUserInput', <?=$trip->id?>)" class="button flex1">Add</button>
    </div>
    <ul class="items">
    <?php foreach (json_decode($trip->travelers) as $userId): ?>
        <?php $user = R::findOne('users', 'id = ?', [$userId]); ?>
        <?php if( $user ) : ?> 
          <li class="flex horizontal flex1">
            <a href="/user.php/<?=$user->id?>">
              <img src="<?=(isset($user->img_src) && !empty($user->img_src) ? $user->img_src :'/dist/images/logos/glimmerjs.svg')?>" />
            </a>
            <div class="flex space-between vertical flex3">
              <a href="/user.php/<?=$user->id?>">
                <h4>
                  <?=$user->login?>
                </h4>
              </a>
              <span><?=$user->email?></span>
              <div class="actions flex space-between horizontal">
                <a href="/" class="author flex horizontal">
                </a>
                <div class="flex flex-end horizontal">
                  <?php if( isset($_SESSION['logged_user']) && $user->id != $trip->author_id &&
                    ( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $trip->author_id)) : ?>
                    <a onclick="rmTraveler(event, <?=$user->id?>, <?=$trip->id?>)" class="button hided warning">remove from trip</a>
                  <?php endif; ?>
                  <a class="button hided" href="/share/user.php/<?=$user->id?>">share</a>
                  <a class="button" href="/user.php/<?=$user->id?>">more</a>
                </div>
              </div>
            </div>

          </li>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="flex space-around horizontal">
      <a href="/">Show more</a>
    </div>
  </ul>
  <script src="../dist/js/travelers.js"></script>
</div>
