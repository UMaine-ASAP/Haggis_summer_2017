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
// $criteria = Criteria::all()[1];
$cNames = array();
$cAvg = array();
$cComments = array();

foreach($projectresponses as $r)
{
  $temp = Criteria::id($r->criteriaID)[1];
  $index = array_search($temp->title, $cNames);
    if( $index != false)
    {
      $cAvg[$index] = ($cAvg[$index] + $r->rating)/2;
      $cComments[$index][] = $r->comment;
    }
    else
    {
      $cNames[] = $temp->title;
      $cAvg[] = $r->rating;
      $cComments[] = array($r->comment);
    }
}

require_once("../views/project/responsesProject.php");
?>
