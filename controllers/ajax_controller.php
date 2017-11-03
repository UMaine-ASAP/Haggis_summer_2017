<?php
require_once('../connection.php');
require_once('../models/evaluate.php');

$evaluations = Evaluate::projectID($_POST['proid'])[1];
echo sizeof($evaluations);
foreach($evaluations as $e)
{
  echo $e->comment."<br>";
  //echo $e;
}


?>
