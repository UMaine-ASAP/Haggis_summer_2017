
<?php

class EventController
{
//=================================================================================== INDEX
  public function add()
  {
    $eventID = Event::create($_POST['title'], $_POST['description'], $_POST['startTime'], $_POST['endTime'], $_POST['startDate'], $_POST['endDate'], $_POST['active'], '1', '1', '1', '1')[1];
    header('Location: index.php');
  }
//=================================================================================== SHOW PROJECTS OF EVENT
  public function showProjects()
  {
    $eventID = $_GET['eventID'];
    $assignmentIDs = Event::getAssignments($eventID)[1];
    $assignments = array();
    foreach($assignmentIDs as $a)
    {
      $assignments[] =  Assignment::id($a)[1];
    }

    foreach($assignments as $a)
    {
      echo "<h4>".$a->title."</h4><br>";
      foreach($a->projects as $p)
      {
        echo $p->title."<br>";
      }
    }
  }

//=================================================================================== ADD ASSINGMENT TO EVENT
  public function addAssignments()
  {
    $result = Event::addAssignment($_POST['event'], $_POST['assignmentID'])[1];
    $_SESSION['controller'] = 'pages';
    $_SESSION['action'] = 'classes';
    $_SESSION['returnto'] = $_POST['classid'];
    //Load index page
    header('Location: index.php');
  }

//=================================================================================== ERROR
  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
