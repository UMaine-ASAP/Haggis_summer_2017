<?php
class ProjectController
{
  //===================================================================================
  public function register()
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
      $projectID = Project::create($title, $desc,'2', $assignmentID)[1];
      for($i = 0; $i < sizeof($fn); $i++)
      {
        EventUser::insert($fn[$i], $mi[$i], $ln[$i], $em[$i],$projectID)[1];
      }
      echo "<div class='projectRegistration'><h2>Project Successfully Submitted</h2></div>";
    }
    else
    {
      $assignment = Assignment::id($_GET['target'])[1];
      require_once('views/project/registerProject.php');
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

    require_once("views/project/evaluateProject.php");
  }
  //===================================================================================
  public function eventEvaluate()
  {
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $criterias = Criteria::eventID($_GET['eventID'])[1];
    $targetid = $_GET['eventID'];
    $projectresponses = Evaluate::projectID($project->id)[1];

    require_once("views/project/evaluateProject.php");
  }
  //===================================================================================
  public function viewResponses()
  {
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $projectresponses = Evaluate::projectID($projectid)[1];
    $cID = array();
    $cNames = array();
    $cAvg = array();
    $cComments = array();

    foreach($projectresponses as $r)
    {
      $temp = Criteria::id($r->criteriaID)[1];
      $check = in_array($temp->id, $cID);
      $user = $r->author;
        if( $check != false)
        {
          $index = array_search($temp->id, $cID);
          $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
          $cComments[$index][] = $r->comment." --".$user->firstName." ".$user->lastName;
        }
        else
        {
          $cID[] = $temp->id;
          $cNames[] = $temp->title;
          $cAvg[] = $r->rating;
          $cComments[] = array($r->comment." --".$user->firstName." ".$user->lastName);
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
    $projectid = $_GET['projectID'];
    $eventid = $_GET['eventID'];
    $project = Project::id($projectid)[1];
    $list = $project->list;
    $ids = array();
    //echo sizeof($list);
    //echo $list;
    //echo "<br>".$projectid;

    require_once("views/project/viewEventProject.php");
  }
}
?>
