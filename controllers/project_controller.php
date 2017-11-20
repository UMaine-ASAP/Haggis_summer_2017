<?php
class ProjectController
{
  public function register()
  {
    $assignment = Assignment::id($_GET['target'])[1];
    require_once('views/project/registerProject.php');

  }

  public function edit()
  {

  }

  public function evaluate()
  {
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $a = Assignment::id($project->assignmentID)[1];
    $projectresponses = Evaluate::projectID($projectid)[1];

    require_once("views/project/evaluateProject.php");
  }

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

  public function viewProject()
  {
    $projectid = $_GET['projectID'];
    $project = Project::id($projectid)[1];
    require_once("views/project/viewProject.php");
  }
}
?>
