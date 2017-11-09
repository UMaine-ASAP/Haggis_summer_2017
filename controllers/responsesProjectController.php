<?php

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
  //echo $user;
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

require_once("../views/project/responsesProject.php");
?>
