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
}
?>
