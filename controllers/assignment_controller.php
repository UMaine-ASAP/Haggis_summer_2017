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
    $assignmentID = $_POST['assignmentID'];
    Assignment::delete($assignmentID);
    $_SESSION['controller'] = 'pages';
    $_SESSION['action'] = 'classes';
    $_SESSION['returnto'] = $_POST['classID'];
    header('Location: index.php');
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

    if(isset($_POST['title']))
    {
      $assignmentID = Assignment::create($_POST['title'],$_POST['assignmentdescription'],$_POST['duetime'],$_POST['duedate'],$klass->id)[1];
      $criteriaSetID;
      if(isset($_POST['savedSetName']))
      {
        $criteriaSetID = Criteria::createSet($_POST['savedSetName'], $_POST['savedSetDescription'])[1];
        $userID = User::getID($_SESSION['token'])[1];
        Criteria::associateWithUser($userID, $criteriaSetID);
      }


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
        Criteria::associateWithAssignment($assignmentID, $currentID);
      }
    }
    if(isset($criteriaSetID))
    {
      foreach($idList as $id)
      Criteria::addToSet($criteriaSetID, $id);
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
                                    "Dear ".$user->firstName." ".$user->lastName.",\nPlease check for new assignments in course ".$klass->coursename.".\nThe assignment is due ".$_POST['duedate'].", at ".$_POST['duetime'].".\n\nDo not reply to this email, the inbox is not monitoried.");
      }

    }
    //Setup a redicrection back to the class page we were working in
    $_SESSION['controller'] = 'pages';
    $_SESSION['action'] = 'classes';
    $_SESSION['returnto'] = $_POST['classid'];
    //Load index page
    header('Location: index.php');
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
    $assignmentID = $_GET['assignmentID'];
    $a = Assignment::id($assignmentID)[1];
    require_once("views/assignment/viewAssignment.php");
  }
  //==========================================================================
  public function details()
  {
    $t;
    if(isset($_GET['id']))
      $t = $_GET['id'];
    else
      $t = $_SESSION['targetid'];
    $a = Assignment::id($t)[1];  //pulls assignments for the relevent class
    require_once('views/assignment/detailsAssignment.php');
  }
}
?>
