<?php
class AssignmentController
{
  public function listAssignments()
  {
    $assignment = Assignment::all()[1];
    require_once('views/assignment/viewAssignments.php');
  }

  public function createAssignment()
  {
    $message;
    if(isset($_POST['title']))
    {
      Assignment::create($_POST['title'],$_POST['description'],$_POST['duetime'],$_POST['duedate'],$_POST['classid'])[1];
      $_SESSION['controller'] = 'pages';
      $_SESSION['action'] = 'classes';
      $_SESSION['returnto'] = $_POST['classid'];

      header('Location: index.php');
    }

  }

}
?>
