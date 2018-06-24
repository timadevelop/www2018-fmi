<li class="flex horizontal flex1">
  <a href="/user/<?=$user->id?>">
    <img src="<?=(isset($user->img_src) && !empty($user->img_src) ? $user->img_src :'https://cdn.svgporn.com/logos/glimmerjs.svg')?>" />
  </a>
  <div class="flex space-between vertical flex3">
    <a href="/user/<?=$user->id?>">
      <h4>
        <?=$user->login?>
      </h4>
    </a>
    <span><?=$user->email?></span>
    <div class="actions flex space-between horizontal">
      <a href="/" class="author flex horizontal">
      </a>
      <div class="flex flex-end horizontal">
        <?php if( isset($_SESSION['logged_user']) &&
          ( $_SESSION['logged_user']->login == 'root' || $_SESSION['logged_user']->id == $user->id)) : ?>
          <a class="button hided warning" href="/action/delete/user.php/<?=$user->id?>">remove</a>
        <?php endif; ?>
        <a class="button hided" href="/share/user/<?=$user->id?>">share</a>
        <a class="button" href="/user.php/<?=$user->id?>">more</a>
      </div>
    </div>
  </div>

</li>
