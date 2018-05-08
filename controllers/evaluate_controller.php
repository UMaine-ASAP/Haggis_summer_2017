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
      echo "<table><tr>";
        echo "<td><h3>Authors</h3><ul>";
        foreach($userList as $u)
        {
          echo "<li><a href='?controller=evaluate&action=byStudent&classID=".$classID."&authorID=".$u->id."'>".$u->firstName." ".$u->lastName."</a></li>";
        }
        echo "</ul></td><td>";
      if(isset($_GET['authorID']))
      {
        $user = User::id($_GET['authorID'])[1];
        echo "<h1>".$user->firstName." ".$user->lastName."</h1>";
        $fetchedEvals = Evaluate::byAuthor($_GET['authorID'])[1];
        echo "<ul>";
        foreach($fetchedEvals as $f)
        {
          echo "<li>".$f->comment."</li>";
        }
      }
      else
      {
        echo '<h2>Please Select an author to view their comments</h2>';
      }
      echo"</td></tr></table>";


    }
}
?>
