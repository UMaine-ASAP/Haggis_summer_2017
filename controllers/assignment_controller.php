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
      $message = Assignment::create($_POST['title'],$_POST['description'],$_POST['duetime'],$_POST['duedate'])[1];
    }
    require_once('views/assignment/createAssignment.php');
  }

}
?>
