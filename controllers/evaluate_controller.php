<?php

class EvaluateController
{
//=================================================================================== INDEX
    public function insert()
    {
      $projectID = $_POST['evalfor'];
      for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
      {
        Evaluate::insert($_POST['criteriaID'][$i], $_POST['criteriaRateing'][$i], $_POST['criteriaComment'][$i], $projectID);
      }
      header('Location: index.php');
    }
}

?>
