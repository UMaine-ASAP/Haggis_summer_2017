<?php
$projectid = $_GET['id'];
if(true)                                  //For debugging only
{                                         //    Set false to remove all error
  ini_set('display_errors', 1);           //    reporting.
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL);
}
require_once('../models/assignment.php');
require_once('../connection.php');
require_once('../models/project.php');
require_once('../models/criteria.php');
require_once('../models/projectUser.php');
require_once('../models/user.php');
require_once('../models/group.php');
require_once('../models/evaluate.php');
$projectid = $_GET['id'];
$project = Project::id($projectid)[1];
$a = Assignment::id($project->assignmentID)[1];
$projectresponses = Evaluate::projectID($projectid)[1];

require_once("../views/project/evaluateProject.php");
?>
