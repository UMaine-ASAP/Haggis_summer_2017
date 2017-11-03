<?php
if(true)                                  //For debugging only
{                                         //    Set false to remove all error
  ini_set('display_errors', 1);           //    reporting.
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL);
}
session_start();
require_once('../models/evaluate.php');
require_once('../connection.php');
require_once('../models/user.php');
$i = 0;
$userid = User::getID($token);

foreach($_POST['criteriaID'])
{
  Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $_POST['projectID'], $userid )[1];
  $i++;
}
?>
