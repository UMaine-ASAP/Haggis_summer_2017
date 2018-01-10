<?php
class AssignmentController
{
  //========================================================================== LIST ASSIGNMENTS
  //pulls all the assignments out of the database
  public function listAssignments()
  {
    $assignment = Assignment::all()[1];
    require_once('views/assignment/viewAssignments.php');
  }

  public function delete()
  {
    $message;
    $assignmentID = $_POST['assignmentid'];
    echo Assignment::delete($assignmentID)[1];
    $_SESSION['controller'] = 'pages';
    $_SESSION['action'] = 'classes';
    $_SESSION['returnto'] = $_POST['classID'];
    echo("<script>location.href = 'index.php';</script>");
  }

  //========================================================================== EDIT ASSIGNMENT
  //Allows for the ability to edit an assignment
  public function editAssignment()
  {
    $assignmentid = $_POST['assignmentid'];
    $assignment = Assignment::id($assignmentid)[1];
    require_once('views/assignment/editAssignment.php');
  }


  //========================================================================== CREATE ASSIGNMENT
  // inserts assignments, criteria, and criteria sets in to the database. Additionally associates created
  //  criteria set to the user, and criteria with assignments
  public function createAssignment()
  {

    $message;
    $assignmentID;
    $klass = Klass::classid($_POST['classid'])[1];
    $userID = User::getID($_SESSION['token'])[1];
    $type;
    $create = false;

    if(isset($_POST['peerEval']))
    {
      $type = 'peer';
      $create = true;
    }
    if(isset($_POST['submissionAssignment']))
    {
      $type = 'submission';
      $create = true;
    }
    if($create)
    {
      $assignmentID = Assignment::create($_POST['title'],$_POST['assignmentdescription'],$_POST['duetime'],$_POST['duedate'],$klass->id, $type)[1];
      $criteriaSetID;
      $rubricID = Rubric::create($_POST['title'], "", $userID)[1];
      Rubric::associateWithAssignment($assignmentID, $rubricID);

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

        $counter++;
      }


      //GROUP/PROJECT CREATION
      if($_POST['makegroup'] == 'true')
      {
        $numofGroups = sizeof($_POST['labels']);
        $groupcounter = 1;
        foreach($_POST['labels'] as $label)
        {
          $projectID = Project::create("Group ".$groupcounter , $_POST['title'], "1", $assignmentID)[1];
          $userIDs = array();
          $counter = 0;
          $groupcounter++;
          foreach($_POST[$label] as $element)
          {
            $userIDs[] = $element;
          }
          $message = Group::create($projectID, $userIDs)[1];
          for($i=0; $i < sizeof($userIDs); $i++)
          {
            $user = User::id($userIDs[$i])[1];
            //echo "<script> alert(".$user->email.");</script>";
            EmailNotification::sendEmail($user->email,
                                       "New Assignment: '".$_POST['title']."'",
                                       "Dear ".$user->firstName." ".$user->lastName.",\nPlease check for new assignments in course ".$klass->coursename.".\nThe assignment is due ".$_POST['duedate'].", at ".$_POST['duetime'].".\n\nDo not reply to this email, the inbox is not monitoried.");
          }
        }
      }
      else
      {
        $ids = $_POST['person'];
        for($i = 0; $i < sizeof($ids);$i++)
        {
          $user = User::id($ids[$i])[1];
          $projectID = Project::create($user->firstName." ".$user->lastName, $_POST['title'], "0", $assignmentID)[1];
          $projectUser = ProjectUser::create($projectID, $user->id, "student", $_POST['assignmentdescription'])[1];
          EmailNotification::sendEmail($user->email,
                                      "New Assignment: '".$_POST['title']."'",
                                      "Dear ".$user->firstName." ".$user->lastName.",\nPlease check for a new assignment in course ".$klass->coursename.".\nThe assignment is due ".date_format(date_create($_POST['duedate']), 'm/d/Y').", at ".date_format(date_create($_POST['duetime']), 'g:i a').".\n\nDo not reply to this email, the inbox is not monitoried.");
        }

      }
      //Setup a redicrection back to the class page we were working in
      $_SESSION['controller'] = 'pages';
      $_SESSION['action'] = 'classes';
      $_SESSION['returnto'] = $_POST['classid'];
    }
    //Load index page
    echo("<script>location.href = 'index.php';</script>");
  }
  //==========================================================================
  public function createAssignmentQuick()
  {
    $class;
    $assignments;
    $classID;
    $idList = array();
    $NumofGroups = 3;
    $userList;

    //fetch criterias to be used in assignment creation
    $criterias = Criteria::all()[1];
    $criteriaList = "<datalist id='criterias'>";
    $criteriaStorage="";
    foreach($criterias as $c)
    {
      $criteriaList .= "<option value='".$c->title."'>";
      $criteriaStorage .= "<input type='hidden' id='".$c->title."' value='".$c->description."'>";
    }
    $criteriaList .="</datalist>";


    //Post routing - checks to see if user is logged in, and directs user back to the class they were in previously
    if(isset($_SESSION['token']))
    {
      $classID = $_GET['classID'];
      $assignments = Assignment::classID($classID)[1];  //pulls assignments for the relevent class
      $class = Klass::classid($classID)[1];             //pulls class data
      $students = User::klass($classID)[1];           //pulls data for students in class
      $userList = User::klass($classID)[1];
    }
    $status = 'user';                                   //checks for admin or user status

    if(User::checkAdmin($_SESSION['token'])[1])
        $status = 'admin';
    require_once('views/assignment/createAssignment.php');

  }
  //==========================================================================
  public function viewAssignment()
  {
    if(User::checkAdmin($_SESSION['token'])[1])
    {
        $status = 'admin';
    }
    else
    {
      $status='user';
    }

    $assignmentID = $_GET['assignmentID'];
    $a = Assignment::id($assignmentID)[1];
    $type = $a->type;
    $e = Event::all()[1];
    $classID = $_GET['classID'];
    require_once("views/assignment/viewAssignment.php");
  }
  //==========================================================================
  public function details()
  {
    $t;                           //$t is a temp variable
    if(isset($_GET['id']))        // Check if we have a GET variable, typical if user clicked to a particular class
      $t = $_GET['id'];
    else
      $t = $_SESSION['targetid'];// Else we check if the session stored the variable to auto return to class after a previous action
    $a = Assignment::id($t)[1];  //pulls assignments for the relevent class


    require_once('views/assignment/detailsAssignment.php');
  }
}
?>
