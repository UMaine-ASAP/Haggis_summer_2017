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
$userid = User::getID($_SESSION['token'])[1];
$i = 0;
for($i  = 0; $i < sizeof($_POST['criteriaID']); $i++)
{
  Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $_POST['projectID'], $userid )[1];
}
?>
