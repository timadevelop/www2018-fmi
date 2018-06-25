<?php require(__DIR__."/../../db.php"); ?>
<?php

$url = $_SERVER['REQUEST_URI'];
// print_r($url);
$query_str = parse_url($url, PHP_URL_QUERY);
parse_str($query_str, $query_params);
// print_r($query_params);
$page = $query_params['page'];
$limit = $query_params['limit'];

$trips=R::findAll('trips', 'ORDER BY created_at LIMIT ?,? ',array((($page-1)*$limit),$limit));
header('Content-type: application/json');
echo json_encode($trips);
?>
