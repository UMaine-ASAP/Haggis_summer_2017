<?php
class AssignmentController
{
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

  public function createAssignment()
  {
    $message;
    $idList = array();
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




      $_SESSION['controller'] = 'pages';
      $_SESSION['action'] = 'classes';
      $_SESSION['returnto'] = $_POST['classid'];


      header('Location: index.php');
    }


}
?>
