<li class="flex horizontal flex1">
  <a href="company.php/<?=$company->id?>">
    <img src="<?=(isset($company->img_src) && !empty($company->img_src) ? $company->img_src :'https://cdn.svgporn.com/logos/glimmerjs.svg')?>" />
  </a>
  <div class="flex space-between vertical flex3">
    <a href="company.php/<?=$company->id?>">
      <h4>
        <?=$company->login?>
      </h4>
    </a>
    <b><?=$company->services?></b>
    <div class="actions flex space-between horizontal">
      <div href="" class="author flex horizontal">
        <p class="hided"><?=$company->email?></p>
      </div>
      <div class="flex flex-end horizontal">
        <?php if( isset($_SESSION['logged_user']) &&
          ( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $company->id)) : ?>
          <a class="button hided warning" href="action/delete/company.php/<?=$company->id?>">remove</a>
        <?php endif; ?>
        <a class="button hided" href="share.php/company/<?=$company->id?>">share</a>
        <a class="button" href="company.php/<?=$company->id?>">more</a>
      </div>
    </div>
  </div>

</li>
