<?php require("db.php"); ?>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../dist/css/base.css" />
  <!-- Add icon library -->
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
          <a href="user.php/">Hello,
            <?php echo $_SESSION['logged_user']->email; ?>
          </a>
          <a class="button" href="logout.php">Log out</a>
        <?php else: ?>
          <a class="button" href="login.php">Log in</a>
          <a class="button special" href="login.php">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php include "parts/messages.php" ?>
