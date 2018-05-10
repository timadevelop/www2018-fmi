<?php
  $data = json_decode(file_get_contents('php://input'), true);
  // print_r($data); // assoc array
  echo(json_encode($data));
?>
