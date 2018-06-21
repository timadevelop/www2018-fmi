<?php
require_once 'functions.php';
require_once "../libs/rb-mysql.php";
if (session_status() == PHP_SESSION_NONE) {
R::setup('mysql:host=localhost;
      dbname=nomadplan','root','');
    session_start();
}


if( ! isset( $_SESSION['messages'] ) )
{
  $_SESSION['messages'] = array();
}
?>
