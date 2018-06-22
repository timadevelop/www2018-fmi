  <?php if ( isset($_SESSION['messages']) && !empty($_SESSION['messages'])) : ?>
   <div id="notifications">
      <div class="flex vertical">
        <?php foreach ($_SESSION['messages'] as $msg): ?>
          <p onclick="hide(event)" class="block"><?=$msg?></p>
        <?php endforeach; ?>
      </div>
    </div>
  <?php $_SESSION['messages'] = array(); ?>
  <?php endif; ?>
