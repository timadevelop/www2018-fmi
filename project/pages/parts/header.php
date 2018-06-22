<?php require("db.php"); ?>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../dist/css/base.css" />
  <!-- Add icon library -->
  <script src="../dist/js/app.js"></script>
  <script src="../dist/js/uihelpers.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="block">
    <div class="head container flex space-between horizontal">
      <div class="left-section flex space-between horizontal">
        <a href="index.php">
          <img src="https://cdn.svgporn.com/logos/nomad.svg"></img>
        </a>
        <input type="text" placeholder="Search trips, services & many more..." />
        <a href="../trips.php">Trips</a>
        <a href="../services.php">Services</a>
        <a href="../users.php">Users</a>
      </div>
      <div class="user-section flex space-between horizontal">
        <?php if ( isset($_SESSION['logged_user']) ) : ?>
        <a class="button" href="new.php">+</a>
        <div class="user-info">
          <img onClick="toogleVisibility('user-details')" src="<?=$_SESSION['logged_user']->img_src?>" />
          <div id='user-details' class="relative">
          <div class="user-details block flex vertical">
            <a href="profile.php"><?=$_SESSION['logged_user']->login?></a>
            <hr>
            <a href="profile.php">profile</a>
            <a href="settings.php">settings</a>
            <a href="logout.php">logout</a>
          </div>
          </div>
        </div>
        <a class="button" href="https://facebook.com/teemofeev" target="_blank">Author</a>
        <?php else: ?>
        <a class="button" href="login.php">Log in</a>
        <a class="button special" href="login.php">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php include "parts/messages.php" ?>
  <div id="app">
