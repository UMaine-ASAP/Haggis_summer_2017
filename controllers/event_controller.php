
<?php

class EventController
{
//=================================================================================== INDEX
  public function add()
  {
    $userID = User::getID($_SESSION['token'])[1];
    $eventID = Event::create($_POST['title'], $_POST['description'], $_POST['startTime'], $_POST['endTime'], $_POST['startDate'], $_POST['endDate'], $_POST['active'], '1', '1', '1', '1')[1];

    $criteriaSetID;
    if($_POST['copyRubric'] == 'true')
    {
      Rubric::associateWithEvent($eventID, $_POST['copyRubricID']);

    }
    else
    {
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
    $userID = User::getID($_SESSION['token'])[1];
    $rubrics = Rubric::byAuthor($userID)[1];
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
        $result = Event::delete($eventID)[1];
        echo("<script>location.href = 'index.php';</script>");

    }

//=================================================================================== ERROR
  public function error()
  {
    require_once('views/home/error.php');
  }
//===================================================================================
  public function projectByScore()
  {
    $eventID = $_GET['eventid'];
    $eventProjects = EventProject::eventID($eventID)[1];
    $ranking = array(0,0,0);
    $projectRankingStorage = array(0,0,0);
    $projectNumber = array();
    $projectTitles = array();
    $projectRankings = array();
    $projectResponseCount = array();
    foreach($eventProjects as $e)
    {

      $projectresponses = Evaluate::eventProjectID($e->id)[1];

      $project = EventProject::id($e->projectID)[1];

      $cID = array();
      $cNames = array();
      $cAvg = array();
      $cComments = array();
      $cRatings = array();
      $dataout = array();
      $finalAvg  = 0;


      foreach($projectresponses as $r)
      {

        $temp = CriteriaSet::id($r->criteriaID)[1][0];

        $check = in_array($temp->title, $cNames);
        $author = $r->author;
          if($check)
          {
            $index = array_search($temp->title, $cNames);
            $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');

            $cComments[$index][] = $r->comment;
          }
          else
          {
            $cID[] = $temp->id;
            $cNames[] = $temp->title;
            $cAvg[] = $r->rating;
            $cComments[] = array($r->comment);
          }
      }
      for($i = 0; $i<sizeof($cNames);$i++)
      {
        $dataout[]= array('lable' => $cNames[$i], 'rating' => $cAvg[$i]);
      }

      if(sizeof($cAvg) != 0)
        $finalAvg = number_format((floatval(array_sum($cAvg)) / sizeof($cAvg)),2,'.','');
      else {
        $finalAvg = 0;
      }

      $projectResponseCount[] = sizeof($cComments[0]);
      $projectNumber[] = $e->projectEventCode;
      $projectTitles[] = $e->title;
      $projectRankings[] =  $finalAvg;

      if($finalAvg > $ranking[0])
      {
        $ranking[2] = $ranking [1];
        $ranking[1] = $ranking [0];
        $ranking[0] = $finalAvg;
        $projectRankingStorage[2] = $projectRankingStorage [1];
        $projectRankingStorage[1] = $projectRankingStorage [0];
        $projectRankingStorage[0] = $e;
      }
      else if($finalAvg > $ranking[1])
      {
        $ranking[1] = $ranking [0];
        $ranking[0] = $finalAvg;
        $projectRankingStorage[1] = $projectRankingStorage [0];
        $projectRankingStorage[0] = $e;
      }
      else if($finalAvg > $ranking[2])
      {
        $ranking[0] = $finalAvg;
        $projectRankingStorage[0] = $e;
      }
    }
    require_once('views/event/eventRankings.php');
  }
}
?>
