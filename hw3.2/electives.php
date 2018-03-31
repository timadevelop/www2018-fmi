<?php
// exploring row id from url
$num = -1;
if(array_key_exists('PATH_INFO', $_SERVER))
{
  $num = pathinfo($_SERVER['PATH_INFO'])['basename'];
}
else if(array_key_exists('QUERY_STRING', $_SERVER))
{
  $num = $_GET['id'];
}
else
{
  unset($num); //
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
 <form method="post">
    <fieldset>
    <legend> Добавяне на ИД </legend>
    <?php if($_SERVER['REQUEST_METHOD'] === 'GET'):?>
      <?php

        if(isset($num))
        {
          try{
            $pdo = new PDO('mysql:host=localhost;dbname=hw2', 'root', '') or die ("Cannot connect");

            $response = $pdo->query("SELECT * FROM electives WHERE id=${num} LIMIT 1");
            if($response)
            {
              $row = $response->fetch(PDO::FETCH_ASSOC);
            }
          }
          catch(PDOException $e)
          {
            echo "Oooops";
          }
        }
      ?>
    <?php endif ?>
    <?php if(isset($row)): ?>
          <label> Име на предмета <input type="text" name="d_name" maxlength="150" value="<?= $row['title'] ?>" required> </label> <br>
          <label> Преподавател   <input type="text" name="t_name" maxlength="200" value="<?= $row['lecturer']?>" required>  </label> <br>
            <label> Описание
            <textarea type="text" name="description" minlength="10" required><?= $row['description'] ?></textarea>
            </label>
    <?php else: ?>
        <label> Име на предмета <input type="text" name="d_name" maxlength="150" required> </label> <br>
        <label> Преподавател   <input type="text" name="t_name" maxlength="200" required>  </label> <br>
        <label> Описание
          <textarea type="text" name="description" minlength="10" required></textarea>
        </label> <br>
    <?php endif ?>
    <button>Submit</button>
    </fieldset>
  </form>
</body>
</html>


<?php

// sql to create table
const SQL_CREATE_TABLE_ELECTIVES = 'CREATE TABLE IF NOT EXISTS electives (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  description VARCHAR(1024),
  lecturer VARCHAR(128)
);';


// sql for adding new column
// by default for all previous rows will be assigned current timestamo
const SQL_MODIFY_TABLE_ELECTIVES = '
  ALTER TABLE electives
  ADD COLUMN IF NOT EXISTS created_at timestamp default current_timestamp';


//
// Data class for data from form
//

class Data
{
  public $d_name = "";
  public $t_name = "";
  public $description = "";
  public $id;
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

      $pdo->exec(SQL_CREATE_TABLE_ELECTIVES);

      $pdo->exec(SQL_MODIFY_TABLE_ELECTIVES);

      $result = $pdo->exec("INSERT INTO electives(id, title, description, lecturer)
        VALUES('{$this->id}','{$this->d_name}','{$this->description}','{$this->t_name}')
        ON DUPLICATE KEY UPDATE
        title = '{$this->d_name}',
        description = '{$this->description}',
        lecturer = '{$this->t_name}';
        ") or die ("Error insertion");
      echo '<br>result of insertion: ' . $result;
      echo '<hr><b>DATABASE CONTENT:</b> <br>';

      echo "<table border='1'>
        <tr>
        <th>teacher</th>
        <th>discipline</th>
        <th>description</th>
        </tr>";
      foreach ($pdo->query("SELECT * FROM electives") as $row) { print '<tr>';
        print '<td>' . $row['lecturer'] . "</td>";
        print '<td>' . $row['title'] . "</td>";
        print '<td>' . $row['description'] . "</td>";
        print '</tr>';
      }
      // print_r($response);
      echo '</table><hr>';
    }
    catch(PDOException $e)
    {
      echo '<br> error' . $e->getMessage();
    }
  }
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($num))
{
  header("Content-Type: text/html; charset=utf-8");
  // there are no requirements for validation, so i'll use validations from my 2nd hw
  //
  // SOME HELPERS (operate global var $valib and $errs)
  //

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
  // init
  $data = new Data;
  $errs = array();
  $valid = array();

  // get all of the data from post to class instance
  $data->d_name = $_POST["d_name"];
  $data->id = $num;
  $data->t_name = $_POST["t_name"];
  $data->description = $_POST["description"];

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

  echo '<hr>';
  if(count($errs) < 1)
  {
    $data->writeToDB();
    // remove these 2 lines below to see DB content after writing to DB
    header('Location: '.$_SERVER['PHP_SELF']); // return to the same page as get
    die;

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
