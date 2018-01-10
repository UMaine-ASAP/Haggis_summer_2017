<?php

  session_start();                          //starts a local session

  if(false)                                  //For debugging only
  {                                         //    Set false to remove all error
    ini_set('display_errors', 1);           //    reporting.
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
  }
  //-------------------------------------------------------> Time to get busy
  require_once('connection.php');          // pulls in our database connection methods
  require_once('vendor/mobiledetect/Mobile_Detect.php');
  $detect = new Mobile_Detect;

  //-------------------------------------------------------> Pre-Routing
  // This system is used to redirect the browser to the context
  //    the user was last in. example: user creates a class, user should be
  //    returned to the class they were in when completing the creation action
  $controller;        //used to store the controller defenition
  $action;            //used to store the action definition
  $mobile = $detect->isMobile(); //detects if the browser is mobile format
  //pulls session redirect information then clears them

  if(isset($_SESSION['returnto']))
  {
    $controller = $_SESSION['controller'];
    $action = $_SESSION['action'];
    unset($_SESSION['controller']);
    unset($_SESSION['action']);
  }

  //grab the data from the URL
  else if(isset($_GET['controller']) && isset($_GET['action']))
  {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
  }
  else if($mobile)
  {
    $controller = 'mobile';
    $action = 'index';
  }
  //or just go straight to the initial page
  else
  {
    $controller = 'pages';
    $action = 'index';
  }

  if($mobile)
    require_once('views/mobilelayout.php');
  else
    require_once('views/layout.php'); //pulls in our layout file
?>
