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
require_once('../views/assignment/createAssignment.php');

?>
