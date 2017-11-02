<?php

require_once('../models/assignment.php');
require_once('../connection.php');
require_once('../models/project.php');
require_once('../models/criteria.php');
require_once('../models/projectUser.php');
require_once('../models/user.php');
require_once('../models/group.php');
$t;
if(isset($_GET['id']))
  $t = $_GET['id'];
else
  $t = $_SESSION['targetid'];
$a = Assignment::id($t)[1];  //pulls assignments for the relevent class
require_once('../views/assignment/detailsAssignment.php');
?>
