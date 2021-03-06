<?php
  $user = R::findOne('users', 'id = ?', array($trip->author_id));
  if( ! $user )
  {
    // $user = array(
    //   'id' => '-1',
    // );
  }
?>

<?php if( $trip->is_public ||
  (isset($_SESSION['logged_user']) && ($_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $trip->author_id))
) : ?>
<li class="flex horizontal flex0 <?php if(!$trip->is_public) echo 'private_trip';?>">
  <a href="/trip.php/<?=$trip->id?>">
    <img src="<?=(isset($trip->img_src) && !empty($trip->img_src) ? $trip->img_src :'/dist/images/logos/glimmerjs.svg')?>" />
  </a>
  <div class="flex space-between vertical flex3">
    <a href="/trip.php/<?=$trip->id?>">
      <h4>
        <?=$trip->title?>
      <?php if(! $trip -> is_public) : ?>
        <i class="fa fa-lock"></i>
      <?php endif; ?>
      </h4>
    </a>
    <span><?=$trip->short_description?></span>
    <div class="actions flex space-between horizontal">
      <div class="author flex horizontal">
        <a href="/user.php/<?=$user->id?>">
          <img  alt="<?=$user->login?>" src="<?=(isset($user->img_src) && !empty($user->img_src) ? $user->img_src :'/dist/images/logos/glimmerjs.svg')?>" />
        </a>
        <?php if($trip->is_public) : ?>
        <img src="/dist/images/logos/unito.svg" />
        <?php else: ?>
        <img src="/dist/images/logos/gusto.svg" />
        <?php endif; ?>
        <img class="hided" src="<?=(isset($trip->img_src) && !empty($trip->img_src) ? $trip->img_src :'/dist/images/logos/gatsby.svg')?>" />
        <img class="hided" src="/dist/images/logos/prettier.svg" />
      </div>
      <div class="flex flex-end horizontal">
       <?php if( isset($_SESSION['logged_user'])): ?>
          <script src="../dist/js/upvote.js"></script>
          <a class="button hided" href="/copy/<?=$trip->id?>">copy</a>
          <?php if( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $trip->author_id) : ?>
            <a class="button hided warning" href="/action/delete/trip.php/<?=$trip->id?>">remove</a>
          <?php endif; ?>
          <?php if(! in_array($_SESSION['logged_user']->id, json_decode($trip->upvotes ))) : ?>
            <a class="button special" onclick="upvote(event, 'trips', <?=$trip->id?>)"><?=count(json_decode($trip->upvotes))?> | upvote</a>
          <?php else: ?>
            <a class="button" onclick="downvote(event, 'trips', <?=$trip->id?>)"><?=count(json_decode($trip->upvotes))?> | upvoted</a>
          <?php endif; ?>
        <?php else: ?>
            <a href="/login" class="button"><?=count(json_decode($trip->upvotes))?> | upvotes</a>
        <?php endif; ?>
        <a class="button" href="/share/<?=$trip->id?>">share</a>
        <a class="button" href="/trip.php/<?=$trip->id?>">more</a>
      </div>
    </div>
  </div>

</li>
<?php else: ?>
<li>Private trip</li>
<?php endif; ?>
