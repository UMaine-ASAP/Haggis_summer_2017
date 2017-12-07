
<?php

class EventController
{
//=================================================================================== INDEX
  public function add()
  {

    $eventID = Event::create($_POST['title'], $_POST['description'], $_POST['startTime'], $_POST['endTime'], $_POST['startDate'], $_POST['endDate'], $_POST['active'], '1', '1', '1', '1')[1];

    for($i = 0; $i < sizeof($_POST['criteriaName']);$i++)
    {
      $allowTextResponse = 1;
      if($_POST['textresponse'.$i] === 'no')
        $allowTextResponse = 0;
      $currentID;
      if($_POST['graded'][$i] === 'yes')
      {
        $currentID = Criteria::insert($_POST['criteriaName'][$i], $_POST['criteriadescription'][$i], $_POST['from'][$i], $_POST['to'][$i], $allowTextResponse)[1];
      }
      else
      {
        $currentID = Criteria::insert($_POST['criteriaName'][$i], $_POST['criteriadescription'][$i], '0', '0', $allowTextResponse)[1];
      }

      $idList[] = $currentID;
      echo $currentID;
      Criteria::associateWithEvent($eventID, $currentID);
    }
  
  if(isset($criteriaSetID))
  {
    foreach($idList as $id)
    Criteria::addToSet($criteriaSetID, $id);
  }



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

  public function createEvent()
  {
    //fetch criterias to be used in event creation
    $criterias = Criteria::all()[1];
    $criteriaList = "<datalist id='criterias'>";
    $criteriaStorage="";
    foreach($criterias as $c)
    {
      $criteriaList .= "<option value='".$c->title."'>";
      $criteriaStorage .= "<input type='hidden' id='".$c->title."' value='".$c->description."'>";
    }
    $criteriaList .="</datalist>";
    require_once('views/event/createEvent.php');
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
