  <?php if ( isset($_SESSION['messages']) && !empty($_SESSION['messages'])) : ?>
    <div class="block">
      <div class="flex space-between horizontal">
        <?php foreach ($_SESSION['messages'] as $msg): ?>
        <h1>
          <?=$msg?> </h1>
        <?php endforeach; ?>
      </div>
    </div>
  <?php $_SESSION['messages'] = array(); ?>
  <?php endif; ?>
