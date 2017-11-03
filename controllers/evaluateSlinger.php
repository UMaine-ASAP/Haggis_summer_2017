<?php
if(true)                                  //For debugging only
{                                         //    Set false to remove all error
  ini_set('display_errors', 1);           //    reporting.
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL);
}
require_once('../models/evaluate.php');
require_once('../connection.php');

Evaluate::submit($_POST['criteriaID'], $_POST['criteriaRating'], $_POST['criteriaComment'], $_POST['projectID'])[1];

?>
