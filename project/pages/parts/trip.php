<?php
  $user = R::findOne('users', 'id = ?', array($trip->author_id));
  if( ! $user )
  {
    echo 'some err';
  }
?>
<li class="flex horizontal flex1">
  <a href="trip.php/<?=$trip->id?>">
    <img src="<?=(isset($trip->img_src) && !empty($trip->img_src) ? $trip->img_src :'https://cdn.svgporn.com/logos/glimmerjs.svg')?>" />
  </a>
  <div class="flex space-between vertical flex3">
    <a href="trip.php/<?=$trip->id?>">
      <h4>
        <?=$trip->title?>
      </h4>
    </a>
    <span><?=$trip->short_description?></span>
    <div class="actions flex space-between horizontal">
      <a href="" class="author flex horizontal">
        <span>by <?=$user->login?></span>
        <?php if($trip->is_public) : ?>
        <img src="https://cdn.svgporn.com/logos/unito.svg" />
        <?php else: ?>
        <img src="https://cdn.svgporn.com/logos/gusto.svg" />
        <?php endif; ?>
        <img class="hided" src="<?=(isset($trip->img_src) && !empty($trip->img_src) ? $trip->img_src :'https://cdn.svgporn.com/logos/gatsby.svg')?>" />
        <img class="hided" src="https://cdn.svgporn.com/logos/prettier.svg" />
      </a>
      <div class="flex flex-end horizontal">
        <?php if( isset($_SESSION['logged_user']) && $_SESSION['logged_user']->id == $trip->author_id) : ?>
          <a class="button hided warning" href="remove.php/<?=$trip->id?>">remove</a>
        <?php endif; ?>
        <a class="button hided" href="share.php/<?=$trip->id?>">share</a>
        <a class="button" href="trip.php/<?=$trip->id?>">more</a>
        <a class="button" href="copy.php/<?=$trip->id?>">copy</a>
      </div>
    </div>
  </div>

</li>
