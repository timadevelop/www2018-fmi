<?php
require_once 'functions.php';
require_once __DIR__."/../libs/rb-mysql.php";
if (session_status() == PHP_SESSION_NONE) {
R::setup('mysql:host=localhost;
      dbname=nomadplan','root','');
    session_start();
}

$_SERVER["DOCUMENT_ROOT"] = '/opt/lampp/htdocs/projects/web2018-fmi/project/pages';

if( ! isset( $_SESSION['messages'] ) )
{
  $_SESSION['messages'] = array();
}
?>
