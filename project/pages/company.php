<?php require("db.php"); ?>
<?php
// if ( session_status() == PHP_SESSION_NONE ||  !isset($_SESSION['logged_company']) ) {
//   array_push($_SESSION['messages'], 'Login, please.');
//   redirect('../login.php');
// }
$id = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$company = R::findOne('companies', 'id = ?', [$id]);

if ( ! $company ) {
  array_push($_SESSION['messages'], "There is no company with id {$id}");
  redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../index.php');
}
?>
  <?php include_once("parts/header.php") ?>

  <?php if ( ! isset($_SESSION['logged_user']) ) : ?>
  <?php include_once("parts/blocks/propose.php") ?>
  <?php endif; ?>


  <div class="container flex space-between horizontal">
    <div class="flex flex-start vertical flex3">
      <div class="block centerItems company">
        <h4>
          Awesome company
        </h4>
        <hr>
        <img src="<?=(isset($company->img_src) && !empty($company->img_src) ? $company->img_src :'/dist/images/logos/glimmerjs.svg')?>" />
        <div class="flex space-between vertical flex3">
          <h4>
            <?=$company->login?>
          </h4>
          <span><?=$company->email?></span>
          <div class="flex center-content horizontal">
            <?php if( isset($_SESSION['logged_company']) &&
                  ( $_SESSION['logged_company']->login == 'root' || $_SESSION['logged_company']->id == $company->id)) : ?>
            <a class="button hided warning" href="action/delete/company.php/<?=$company->id?>">remove</a>
            <?php endif; ?>
            <a class="button hided" href="share/company.php/<?=$company->id?>">share</a>
            <a class="button" href="company.php/<?=$company->id?>">more</a>
          </div>
        </div>
      </div>

    <div class="block">
      <h4><?=$company->login?>'s services</h4>
        <hr>
        <ul class="items">
      <?php
        $services = R::find('services', 'company_id = ?', [$company->id]);
      ?>
          <?php foreach ($services as $service): ?>
            <?php include('parts/service.php') ?>
          <?php endforeach; ?>
          <div class="flex space-around horizontal">
            <a href="">Show more</a>
          </div>
        </ul>
      </div>
    </div>
    <div class="flex flex-start vertical flex2">
      <?php include_once("parts/blocks/news.php") ?>
      <?php include_once("parts/blocks/subscribe.php") ?>
      <?php include_once("parts/blocks/facebook.php") ?>
      <?php include_once("parts/foot.php") ?>
    </div>

  </div>

  <?php include_once("parts/footer.php") ?>
