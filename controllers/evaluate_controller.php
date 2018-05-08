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
      for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
      {
        $result = Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $_POST['evalfor'], $userid, $type )[1];

      }
      echo "<h3>Your evaluation was successfully submitted</h3>";

      if(isset($_GET['mobile']))
      {
        $eventID = $_SESSION['eventID'];
        header('Location: ?controller=mobile&action=projects&eventID='.$eventID);
        unset($_SESSION['eventID']);
      }
    }

    //===================================================================================
    public function byStudent()
    {
      $classID = $_GET['classID'];
      $userList = User::klass($classID)[1];
      $authorID;
      $user;
      $selected = false;

      if(isset($_GET['authorID']))
      {
        $selected = true;
        $user = User::id($_GET['authorID'])[1];
      }
      require_once('views/class/viewStudentResponses.php');

    }
}
?>
