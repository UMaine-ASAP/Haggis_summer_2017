<?php

class EvaluateController
{
//=================================================================================== INDEX
    public function submit()
    {
      $projectID = $_POST['evalfor'];
      for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
      {
        echo Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRateing'][$i], $_POST['criteriaComment'][$i], $projectID)[1]."<br>";
      }
      //header('Location: index.php'); 
    }
}
?>