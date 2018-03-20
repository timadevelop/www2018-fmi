<!--

Домашно 2 - Form Validation [25.03]
Направете форма за добавяне на избираеми дисциплини и сървърна част, която да показва, валидира и записва формата. Тя трябва да съдържа:

Име на предмета - задължително, с максимална дължина - 150 символа
Преподавател - задължително, с максимална дължина - 200 символа
Описание - задължително, минимална дължина - 10 символа
Група - една измежду М, ПМ, ОКН и ЯКН
Кредити - цяло положително число
Всяко поле трябва да отговаря на посочения тип и да има валидация по зададените правила.

Засега е ок всичко да е в един файл за домашните. Когато понаучим още неща обръщаме по-голямо внимание на разделянето на различните действия.

-->
<?php

class Data
{
  public $d_name = "";
  public $t_name = "";
  public $description = "";
  public $group = "";
  public $credits = 0;

}

$data = new Data;
$errs = array();
$valid = array();


function checkGroup($g)
{
  return $g == "M" || $g == "PM" || $g == "OKN" || $g == "YKN";
}

function check($prop, $len, $errmsg, $validmsg, $check_max=true)
{
  global $valid;
  global $errs;
  if(!is_string($prop)
    || ($check_max ? strlen($prop) > $len : strlen($prop) < $len))
  {
    // echo '<br>error<br>';
    $errs[$prop] = $errmsg;
    return false;
  }
  // else
  ///echo ("here it is: " . $prop . '<br>');
  $valid[$prop] = $validmsg;
  return true;
}

if($_POST)
{

  $data->d_name = $_POST["d_name"];
  $data->t_name = $_POST["t_name"];
  $data->description = $_POST["description"];
  $data->group = $_POST["group"];
  $data->credits = $_POST["credits"];

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

  foreach($errs as $key => $err)
  {
    echo "<br>Error => " . $err . ", but the length of your string is " . strlen($key);
  }

  foreach($valid as $key => $msg)
  {
    echo "<br>Valid => " . $msg . " : " . $key ;
  }

  if(checkGroup($data->group))
  {
    echo '<br>Valid => group:' . $data->group;
  }
  else
  {
    echo '<br>Error => ' . $data->group;
  }


  if($data->credits < 0)
  {
    echo "<br> Error => credits must be positiive ($data->credits is not >= 0)<br>";
  }
  else
  {
    echo '<br>credits:' . $data->credits . '<br>';
  }



}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

</head>

<body>
<form method="post" >

<fieldset>
  <legend> Добавяне на ИД </legend>
  <label> Име на предмета <input type="text" name="d_name" /*maxlength="150"*/ required> </label> <br>
  <label> Преподавател   <input type="text" name="t_name" /*maxlength="200"*/ required>  </label> <br>
  <label> Описание
    <textarea type="text" name="description" /*minlength="10"*/ required></textarea>
  </label> <br>
  <label> Група
   <select name="group">
      <option value="M">М</option>
      <option value="PM">ПМ</option>
      <option value="OKN">ОКН</option>
      <option value="YKN">ЯКН</option>
    </select>
  </label><br>
  <label> Кредити <input type="number" /*min="0"*/ name="credits"></label><br>
  <button>Submit</button>
</fieldset>

</form>


</body>
</html>
