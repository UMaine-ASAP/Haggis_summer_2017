<?php
class ProjectController
{
  //===================================================================================
  public function registerAssignment()
  {
    if(isset($_POST['targetid']))
    {
      $assignmentID = $_POST['targetid'];
      $title = $_POST['projectname'];
      $desc = $_POST['projectdesc'];
      //$abst = $_POST['abst'];
      //$PI = $_POST['principleInvestigator'];
      $fn = $_POST['firstName'];
      $mi = $_POST['middleInitial'];
      $ln = $_POST['lastname'];
      $em = $_POST['email'];
      $projectID = EventProject::create($title, $desc,'', "-2", '0')[1];
      for($i = 0; $i < sizeof($fn); $i++)
      {
        $temp = EventUser::insert($fn[$i], $mi[$i], $ln[$i], $em[$i],$projectID)[1];
        EventProject::associatewitheventuser($projectID, $temp);

      }
      echo "<div class='projectRegistration'><h2>Project Successfully Submitted</h2></div>";
    }
    else
    {
      $assignment = Assignment::id($_GET['target'])[1];
      require_once('views/project/registerAssignmentProject.php');
    }
  }
  //===================================================================================
  public function registerEvent()
  {
    if(isset($_POST['targetid']))
    {
      $eventID = $_POST['targetid'];
      $title = $_POST['projectname'];
      $desc = $_POST['projectdesc'];
      $abst = " ";//$_POST['abst'];
      //$PI = $_POST['principleInvestigator'];
      $fn = $_POST['firstName'];
      $mi = $_POST['middleInitial'];
      $ln = $_POST['lastname'];
      $em = $_POST['email'];
      $eventprojectID = EventProject::create($title, $desc,$abst,'-2', '0')[1];
      EventProject::associatewithevent($eventprojectID, $eventID);
      for($i = 0; $i < sizeof($fn); $i++)
      {
        $temp = EventUser::insert($fn[$i], $mi[$i], $ln[$i], $em[$i],$eventprojectID)[1];
        EventProject::associatewitheventuser($eventprojectID, $temp);

      }
      echo "<div class='projectRegistration'><h2>Project Successfully Submitted</h2></div>";
    }
    else
    {
      $e = Event::id($_GET['target'])[1];
      require_once('views/project/registerEventProject.php');
    }
  }

  //===================================================================================
  public function edit()
  {

  }
  //===================================================================================
  public function assignmentEvaluate()
  {
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $targetid = $project->assignmentID;
    $criterias = $a->criterias;
    $projectresponses = Evaluate::projectID($projectid)[1];
    $type = '1';

    require_once("views/project/evaluateProject.php");
  }
  //===================================================================================
  public function eventEvaluate()
  {
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $criterias = Criteria::eventID($_GET['eventID'])[1];
    $targetid = $_GET['eventID'];
    $projectresponses = Evaluate::projectID($project->id,'2')[1];
    $type = '2';

    require_once("views/project/evaluateProject.php");
  }
  //===================================================================================
  public function viewResponses()
  {
    $type = $_GET['type'];
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $projectresponses;
    if($type ='1')
    {
      $projectresponses = Evaluate::projectID($projectid)[1];
    }
    if($type = '2')
    {
      $projectresponses = Evaluate::eventProjectID($projectid)[1];
    }

    $cID = array();
    $cNames = array();
    $cAvg = array();
    $cComments = array();

    foreach($projectresponses as $r)
    {
      $temp = Criteria::id($r->criteriaID)[1];

      $check = in_array($temp->title, $cNames);
      $author = $r->author;
        if($check)
        {
          $index = array_search($temp->title, $cNames);
          $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
          if($type == '2')
          {
            $cComments[$index][] = "-- ".$r->comment;
          }
          else
          {
            $cComments[$index][] = $r->comment." --".$user->firstName." ".$user->lastName;
          }
        }
        else
        {
          $cID[] = $temp->id;
          $cNames[] = $temp->title;
          $cAvg[] = $r->rating;
          if($type == '2')
          {
            $cComments[] = array("-- ".$r->comment);
          }
          else
          {
            $cComments[] = array($r->comment." --".$user->firstName." ".$user->lastName);
          }
        }
    }

    require_once("views/project/responsesProject.php");
  }
  //===================================================================================
  public function viewAssignmentProject()
  {
    $assignedUser=false;
    $userID = User::getID($_SESSION['token'])[1];
    $projectid = $_GET['projectID'];
    $project = Project::id($projectid)[1];
    $list = $project->list;
    $ids = array();
    //echo sizeof($list);
    //echo $list;
    //echo "<br>".$projectid;
    switch($project->isgroup)
    {
      case '0':

        foreach($list as $pu)
        {

          echo $u->userID;

          $ids[] = $u->userID;
          if($u->id == $userID)
            $assignedUser = true;
        }
        break;
      case '2':
        //Go through EventUsers(eventID)
        break;
      case '1':
      foreach($list as $u)
      {
        $ids[] = $u->id;
        if($u->id == $userID)
          $assignedUser = true;
      }
        break;
    }
    require_once("views/project/viewAssignmentProject.php");
  }

  //===================================================================================
  public function viewEventProject()
  {
    $project;
    $list;
    $projectid = $_GET['projectID'];
    $eventid = $_GET['eventID'];
    $type = $_GET['type'];
    if($type == '1')
    {
      $project = Project::id($projectid)[1];
      $list = $project->list;
    }

    if($type == '2')
      $project = EventProject::id($projectid)[1];

    $ids = array();
    //echo sizeof($list);
    //echo $list;
    //echo "<br>".$projectid;

    require_once("views/project/viewEventProject.php");
  }
}
?>
