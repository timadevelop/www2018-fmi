<?php include_once("parts/header.php") ?>
<?php if (session_status() == PHP_SESSION_NONE) : ?>
<div class="block">
  <div class="container flex space-between horizontal">
    <div class="flex space-around vertical flex2" style="padding-right: 200px;">
      <h1>Discover your next favorite thing</h1>
      <p>Product Hunt surfaces the best new products, every day. It's a place for product-loving enthusiasts to share and geek out about the latest mobile apps, websites, hardware projects, and tech creations.</p>
    </div>
    <div class="flex flex1">
      <img style="width:240px;height:221px;margin: 20px;" src="https://s3.producthunt.com/static/kitty_265x244%402x.png" />
    </div>
  </div>
</div>
<?php endif; ?>

<div class="container flex space-between horizontal mt30">
  <div class="flex flex-start vertical flex2">
    <div class="block">
      <div class="flex space-between vertical">
        <div class="trip-navigation">
          <nav class="flex horizontal space-around">
            <a onclick="changeTab(this, 'modify-trip-scenario')" class="selected">Scenario</a>
            <a onclick="changeTab(this, 'modify-trip-transport')">Transport</a>
          </nav>

        </div>
      </div>
    </div>
  </div>
  <div class="flex flex-start vertical flex1">
    <div class="block">
      <h1>Some news</h1>
      <hr>
      <p>Some text session_status() == PHP_SESSION_NONE </p>
    </div>
    <div class="block">
      <div class="flex space-between vertical">
        <div class="trip-navigation">
          <nav class="flex horizontal space-around">
            <a onclick="changeTab(this, 'modify-trip-scenario')" class="selected">Scenario</a>
            <a onclick="changeTab(this, 'modify-trip-transport')">Transport</a>
          </nav>

        </div>
      </div>
    </div>
  </div>

</div>




<?php include_once("parts/footer.php") ?>
