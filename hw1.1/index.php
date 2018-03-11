<?php
  //
  // helpers
  //

  function generateHeader($digits)
  {
    echo "<tr>";
    foreach($digits as $digit)
    {
      echo "<th> $digit </th>";
    }
    echo "</tr>";
  }

  function generateTable($digits)
  {
    foreach($digits as $digit)
    {
      echo "<tr>";
      echo "<th> $digit </th>";
      foreach($digits as $d)
      {
        echo "<td>" . $digit*$d . "</td>";
      }
      echo "</tr>";
    }
  }

  // generating a table
  $digits = range(1, 9);

  // open table
  echo "
  <table>
  <tbody>";

  generateHeader($digits);
  generateTable(array_slice($digits, 1));

  // close table
  echo "
  </tbody>
  </table>";
?>

<link rel="stylesheet" href="index.css" type="text/css">
