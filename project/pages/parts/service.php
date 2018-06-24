<?php
  $company = R::findOne('companies', 'id = ?', array($service->company_id));
  if( ! $company )
  {
    // TODO:
  }
?>
<li class="flex horizontal flex1">
  <a href="/service/<?=$service->id?>">
    <img src="<?=(isset($service->img_src) && !empty($service->img_src) ? $service->img_src :'https://cdn.svgporn.com/logos/glimmerjs.svg')?>" />
  </a>
  <div class="flex space-between vertical flex3">
    <a href="/service/<?=$service->id?>">
      <h4>
        <?=$service->title?>
      </h4>
    </a>
    <span><?=$service->short_description?></span>
    <div class="actions flex space-between horizontal">
      <div class="author flex horizontal">
        <a href="/company/<?=$company->login?>">
          <img
              alt="<?=$company->login?>"
              src="<?=(isset($company->img_src) && !empty($company->img_src) ? $company->img_src :'https://cdn.svgporn.com/logos/gatsby.svg')?>" />
        </a>
        <?php if($service->is_public) : ?>
        <img class="hided" src="https://cdn.svgporn.com/logos/unito.svg" />
        <?php else: ?>
        <img class="hided" src="https://cdn.svgporn.com/logos/gusto.svg" />
        <?php endif; ?>
        <img class="hided" src="https://cdn.svgporn.com/logos/prettier.svg" />
      </div>
      <div class="flex flex-end horizontal">
        <?php if( (isset($_SESSION['logged_user']) && $_SESSION['logged_user']->id == $service->company_id ) || $_SESSION['logged_user']->login == 'root') : ?>
          <a class="button hided warning" href="/action/delete/service.php/<?=$service->id?>">remove</a>
        <?php endif; ?>
        <a class="button hided" href="/share/<?=$service->id?>">share</a>
        <a class="button" href="/service.php/<?=$service->id?>">more</a>
        <a class="button" href="/copy/<?=$service->id?>">copy</a>
      </div>
    </div>
  </div>

</li>
