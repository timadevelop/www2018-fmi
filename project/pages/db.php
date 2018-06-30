<?php
require_once 'config.php';
require_once __DIR__."/../libs/rb-mysql.php";
require_once 'functions.php';

$Config = new Config;

if (session_status() == PHP_SESSION_NONE) {
  R::setup('mysql:host=127.0.0.1;
        dbname='.$Config::DB_NAME,$Config::DB_USER, $Config::DB_PASS);
      session_start();
}

if( ! isset( $_SESSION['messages'] ) )
{
  $_SESSION['messages'] = array();
}
?>
