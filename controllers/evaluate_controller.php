<?php

class EvaluateController
{
//=================================================================================== INDEX
    public function submit()
    {
      $type = $_POST['type'];
      $userid = -1;
      if(isset($_SESSION['token']))
      {
        $userid = User::getID($_SESSION['token'])[1];
      }
      $targetID = $_POST['evalfor'];
      for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
      {
        echo Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $targetID, $userid, $type )[1];
      }
      //header('Location: index.php');
    }
}
?>
