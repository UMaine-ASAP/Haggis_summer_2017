<?php
if(true)                                  //For debugging only
{                                         //    Set false to remove all error
  ini_set('display_errors', 1);           //    reporting.
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL);
}
 require_once('../models/klass.php');         //we pull our models in and get them ready to be used by the controllers
 require_once('../models/assignment.php');
 require_once('../models/course.php');
 require_once('../models/criteria.php');
 require_once('../models/user.php');
 require_once('../models/project.php');
 require_once('../models/projectUser.php');
 require_once('../models/group.php');
 require_once('../connection.php');
session_start();

$assignmentID = $_GET['assignmentID'];

$a = Assignment::id($assignmentID)[1];
require_once("../views/assignment/viewAssignment.php");

?>
