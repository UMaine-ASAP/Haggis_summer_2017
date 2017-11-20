<?php

class EvaluateController
{
//=================================================================================== INDEX
    public function submit()
    {
      $userid = User::getID($_SESSION['token'])[1];
      $projectID = $_POST['evalfor'];
      for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
      {
        echo Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $projectID, $userid )[1];
      }
      //header('Location: index.php');
    }
}
?>
