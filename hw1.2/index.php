<?php

//
// Impl
//

function showPage($data, $pageId)
{
  $result = '';
  foreach($data[$pageId] as $key => $value)
  {
    $result = $result . "<$key> $value </$key>\n";
  }

  return $result;
}

function showNav($data, $pageId)
{
  $result = '<nav>';
  foreach($data as $key => $value)
  {
    $selected = $pageId == $key ? ' class="selected"' : '';
    $href = 'href="?page=' . $key . '"';
    $result = $result . "<a $href" . $selected . "> " . $value['title'] . " </a>";
  }
  $result = $result . "</nav>";
  return $result;
}

//
// Test
//

/*
$data = [
  'webgl' => [
    'title' => 'Компютърна графика с WebGL',
    'description' => '...',
    'lecturer' => 'доц. П. Бойчев',
  ],
  'go' => [
    'title' => 'Програмиране с Go',
    'description' => '...',
    'lecturer' => 'Николай Бачийски',
  ]
];
 */


// echo htmlspecialchars(showPage($data, 'go'));
/*
<h1> Компютърна графика с WebGL </h1> 
<h2> доц. П. Бойчев </h2> 
<p> ... </p> 
 */


// echo htmlspecialchars(showNav($data, 'webgl'));
/*
<nav> 
  <a href="?page=webgl" class="selected"> Компютърна графика с WebGL </a> 
  <a href="?page=go"> Програмиране с Go </a> 
</nav> 
 */

?>
