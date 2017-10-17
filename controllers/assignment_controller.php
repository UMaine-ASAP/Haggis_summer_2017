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

    if(isset($_POST['title']))
    {
      $assignmentID = Assignment::create($_POST['title'],$_POST['assignmentdescription'],$_POST['duetime'],$_POST['duedate'],$_POST['classid'])[1];
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
        if($_POST['textresponse'][$i] === 'no')
          $allowTextResponse = 0;
        $currentID;
        if($_POST['graded'][$i] == 'yes')
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
      foreach($_POST['labels'] as $label)
      {
        $projectID = Project::create($_POST['title'], $_POST['assignmentdescription'], "1", $assignmentID)[1];
        $userIDs = array();
        $counter = 0;
        echo $label;
        foreach($_POST[$label] as $element)
        {
          $userIDs[] = $element;
        }
        $message = Group::create($projectID, $userIDs)[1];
      }
    }
    else
    {
      $userList = User::klass($_POST['classid'])[1];
      foreach($userList as $user)
      {
        $projectID = Project::create($_POST['title'], $_POST['assignmentdescription'], "0", $assignmentID)[1];
        $projectUser = ProjectUser::create($projectID, $user->id, "student", $_POST['assignmentdescription'])[1];
      }

    }
    //Setup a redicrection back to the class page we were working in
    $_SESSION['controller'] = 'pages';
    $_SESSION['action'] = 'classes';
    $_SESSION['returnto'] = $_POST['classid'];
    //Load index page
    header('Location: index.php');
  }
}
?>
