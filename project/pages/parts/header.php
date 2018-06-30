<?php require("db.php"); ?>
<html>

<head>
  <title>Nomadplan</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/dist/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/dist/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/dist/images/favicons/favicon-16x16.png">
  <link rel="manifest" href="/dist/images/favicon/site.webmanifest">
  <link rel="mask-icon" href="/dist/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#00aba9">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" type="text/css" href="../dist/css/base.css" />
  <meta name="viewport" content="width=device-width">

  <!-- Add icon library -->
  <script src="../dist/js/app.js"></script>
  <script src="../dist/js/uihelpers.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="block">
    <div class="head container flex space-between horizontal">
      <div class="left-section flex space-between horizontal">
        <div>
        <a href="/">
          <img src="/dist/images/logos/nomad.svg"></img>
        </a>
        <input type="text" placeholder="Search trips, services & many more..." />
        </div>
        <div class="links">
        <a href="/trips">Trips</a>
        <a href="/services">Services</a>
        <a href="/users">Users</a>
        <a href="/companies">Companies</a>
        </div>
      </div>
      <div class="user-section flex space-between horizontal">
        <?php if ( isset($_SESSION['logged_user']) ) : ?>
          <?php if ( isset($_SESSION['logged_user']->services) ) : ?>
            <a class="button" href="/newservice">+</a>
          <?php else: ?>
            <a class="button" href="/new">+</a>
          <?php endif; ?>
        <div class="user-info">
          <img onClick="toogleVisibility('user-details')" src="<?=$_SESSION['logged_user']->img_src?>" />
          <div id='user-details' class="relative">
          <div class="user-details block flex vertical">
            <a href="/profile"><?=$_SESSION['logged_user']->login?></a>
            <hr>
            <a href="/profile">profile</a>
            <a href="/settings">settings</a>
            <a href="/logout">logout</a>
          </div>
          </div>
        </div>
        <a class="button" href="https://facebook.com/teemofeev" target="_blank">Author</a>
        <?php else: ?>
        <a class="button" href="/login">Log in</a>
        <a class="button special" href="/login">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php include $_SERVER["DOCUMENT_ROOT"]."/parts/messages.php" ?>
  <div id="app">
