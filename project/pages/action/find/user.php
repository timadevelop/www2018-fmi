<?php require(__DIR__."/../../db.php"); ?>
<?php

$login = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$user = R::findOne('users', 'login = ?', [$login]);
header('Content-type: application/json');
echo json_encode($user);
?>
