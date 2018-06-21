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
        <?php if($trip->is_public) : ?>
        <img src="https://cdn.svgporn.com/logos/unito.svg" />
        <?php else: ?>
        <img src="https://cdn.svgporn.com/logos/gusto.svg" />
        <?php endif; ?>
        <img class="hided" src="<?=(isset($trip->img_src) && !empty($trip->img_src) ? $trip->img_src :'https://cdn.svgporn.com/logos/gatsby.svg')?>" />
        <img class="hided" src="https://cdn.svgporn.com/logos/prettier.svg" />
      </a>
      <div class="flex flex-end horizontal">
        <a class="button hided" href="share.php/<?=$trip->id?>">share</a>
        <a class="button" href="trip.php/<?=$trip->id?>">more</a>
        <a class="button" href="copy.php/<?=$trip->id?>">copy</a>
      </div>
    </div>
  </div>

</li>
