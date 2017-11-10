<?php

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
    if( $check != false)
    {
      $index = array_search($temp->id, $cID);
      $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
      $cComments[$index][] = $r->comment;
    }
    else
    {
      $cID[] = $temp->id;
      $cNames[] = $temp->title;
      $cAvg[] = $r->rating;
      $cComments[] = array($r->comment);
    }
}
// The HTML is at this location  |
//                              \/
require_once("views/project/responsesProject.php");

?>
