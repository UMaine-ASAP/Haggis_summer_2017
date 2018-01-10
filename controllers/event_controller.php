
<?php

class EventController
{
//=================================================================================== INDEX
  public function add()
  {
    $userID = User::getID($_SESSION['token'])[1];
    $eventID = Event::create($_POST['title'], $_POST['description'], $_POST['startTime'], $_POST['endTime'], $_POST['startDate'], $_POST['endDate'], $_POST['active'], '1', '1', '1', '1')[1];
    $rubricID = Rubric::create($_POST['title'], "", $userID)[1];
    Rubric::associateWithEvent($eventID, $rubricID);
    $criteriaSetID;

    $counter = 1;
    foreach($_POST['criterianame'] as $criName)
    {
      $criteriaSetID = CriteriaSet::insert($criName,"",$_POST['rangePoint'][0],$_POST['rangePoint'][sizeof($_POST['rangePoint'])-1], "1")[1];
      Rubric::associateWithRubric($rubricID, $criteriaSetID);
      $counter2 = 0;
      foreach($_POST[$counter] as $cri)
      {
        $criteriaID = Criteria::insert($criName, $cri, $_POST['rangePoint'][$counter2])[1];
        CriteriaSet::addCriteriaToSet($criteriaSetID, $criteriaID);
        $counter2++;
      }
      // CriteriaSet::associateWithEvent($eventID, $criteriaSetID);
      $counter++;
    }




  echo("<script>location.href = 'index.php';</script>");
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
  public function addAssignment()
  {
    $result = Event::addAssignment($_POST['event'], $_POST['assignmentID'])[1];
    $_SESSION['controller'] = 'pages';
    $_SESSION['action'] = 'classes';
    $_SESSION['returnto'] = $_POST['classid'];
    //Load index page
    echo("<script>location.href = 'index.php';</script>");
  }
  //=================================================================================== ADD ASSINGMENT TO EVENT
    public function setActive()
    {
      $result = Event::setActive($_GET['eventid'], $_GET['status'])[1];
      //Load index page
      $_SESSION['controller'] = 'pages';
      $_SESSION['action'] = 'events';
      $_SESSION['returnto'] = $_GET['eventid'];
      echo("<script>location.href = 'index.php';</script>");
    }
  //=================================================================================== ERROR
    public function delete()
    {
        $eventID = $_GET['id'];
        $result = Event::delete($eventID);
        echo("<script>location.href = 'index.php';</script>");

    }

//=================================================================================== ERROR
  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
