<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
  <form method="post">
    <fieldset>
      <legend> Добавяне на ИД </legend>
      <label> Име на предмета <input type="text" name="d_name" /*maxlength="150"*/ required> </label> <br>
      <label> Преподавател   <input type="text" name="t_name" /*maxlength="200"*/ required>  </label> <br>
      <label> Описание
        <textarea type="text" name="description" /*minlength="10"*/ required></textarea>
      </label> <br>
      <label> Група
        <select name="group">
          <option value="М">М</option>
          <option value="ПМ">ПМ</option>
          <option value="ОКН">ОКН</option>
          <option value="ЯКН">ЯКН</option>
        </select>
      </label><br>
      <label> Кредити <input type="number" /*min="0"*/ name="credits"></label><br>
      <button>Submit</button>
    </fieldset>
  </form>
</body>
</html>


<?php
header("Content-Type: text/html; charset=utf-8");

// sql to create table
const SQL_CREATE_TABLE_DISC = 'CREATE TABLE IF NOT EXISTS Discipline (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  d_name VARCHAR(30) NOT NULL,
  t_name VARCHAR(30) NOT NULL,
  description VARCHAR(500) NOT NULL,
  m_group VARCHAR(5),
  credits INT(6) UNSIGNED
)';

//
// SOME HELPERS (operate global var $valib and $errs)
//

function checkGroup($g)
{
  global $errs, $valid;
  if($g == "М" || $g == "ПМ" || $g == "ОКН" || $g == "ЯКН")
  {
    $valid[$g] = "group is ok";
    return true;
  }

  $errs[$g] = "fail group";
  return false;
}

function check($prop, $len, $errmsg, $validmsg, $check_max=true)
{
  global $errs, $valid;
  if(!is_string($prop) || ($check_max ? strlen($prop) > $len : strlen($prop) < $len))
  {
    $errs[$prop] = $errmsg;
    return false;
  }
  $valid[$prop] = $validmsg;
  return true;
}

function checkCredits($credits)
{
  global $errs, $valid;
  if($credits < 0)
  {
    $errs['credits'] = "Error => credits must be positiive ($credits is not >= 0)";
    return false;
  }
  $valid['credits'] = 'Valid => credits:' . $credits;
  return true;
}

//
// Data class for data from form
//

class Data
{
  public $d_name = "";
  public $t_name = "";
  public $description = "";
  public $group = "";
  public $credits = 0;

  public function writeToDB()
  {
    echo '<b>Info about insertion:</b>';
    echo "<br>all data is ok, try to write";
    // write to db
    try
    {
      // I could write a code for creating database hw2 from host,
      // but I think that it's not a purpose of this hw
      $pdo = new PDO('mysql:host=localhost;dbname=hw2', 'root', '') or die ("Cannot connect");
      $pdo->exec("SET NAMES = utf8");

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $pdo->exec(SQL_CREATE_TABLE_DISC);
      $result = $pdo->exec("INSERT INTO Discipline(d_name,t_name, description, m_group, credits)
      VALUES(
        '{$this->d_name}',
        '{$this->t_name}',
        '{$this->description}',
        '{$this->group}',
        {$this->credits}
      )") or die ("Error insertion");
      echo '<br>result of insertion: ' . $result;
      echo '<hr><b>DATABASE CONTENT:</b> <br>';


      echo "<table border='1'>
      <tr>
      <th>teacher</th>
      <th>discipline</th>
      <th>group</th>
      <th>description</th>
      <th>credits</th>
      </tr>";
      foreach ($pdo->query("SELECT * FROM Discipline") as $row) {
        print '<tr>';
        print '<td>' . $row['t_name'] . "</td>";
        print '<td>' . $row['d_name'] . "</td>";
        print '<td>' . $row['m_group'] . "</td>";
        print '<td>' . $row['description'] . "</td>";
        print '<td>' . $row['credits'] . "</td>";
        print '</tr>';
      }
      // $pdo->close();
      // print_r($response);
      echo '</table><hr>';
    }
    catch(PDOException $e)
    {
      echo '<br> error' . $e->getMessage();
    }
  }
}

if($_POST)
{
  // init
  $data = new Data;
  $errs = array();
  $valid = array();

  // get all of the data from post to class instance
  $data->d_name = $_POST["d_name"];
  $data->t_name = $_POST["t_name"];
  $data->description = $_POST["description"];
  $data->group = $_POST["group"];
  $data->credits = $_POST["credits"];

  // check if data is valid
  check($data->d_name, 150,
  'Име на предмета - задължително, с максимална дължина - 150 символа',
  'Ok, име на предмета е <= 150');
  check($data->t_name, 200,
  'Преподавател - задължително, с максимална дължина - 200 символа',
  'Ok, име на преподавател е <= 200');

  check($data->description, 10,
  'Описание - задължително, минимална дължина - 10 символа',
  'Ok, описание е > 10',
  false);

  checkGroup($data->group);
  checkCredits($data->credits);

  echo '<hr>';
  if(count($errs) < 1)
  {
    $data->writeToDB();
  }
  else
  {
    echo 'errors, nothing to write.';
    // it's better to use {} blocks, but this is php homework, i
    foreach($errs as $key => $err) echo "<br>Error => " . $err . ", but the length of your string is " . strlen($key);
    foreach($valid as $key => $msg) echo "<br>Valid => " . $msg . " : " . $key;
  }
}
?>
