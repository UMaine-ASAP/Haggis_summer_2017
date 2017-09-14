<?php

  session_start();                          //starts a local session
  require_once('connection.php');          // pulls in our database connection methods
  //-------------------------------------------------------> Error Reporting
  if(true)                                  //For debugging only
  {                                         //    Set false to remove all error
    ini_set('display_errors', 1);           //    reporting.
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
  }


  //-------------------------------------------------------> Pre-Routing
  // This system is used to redirect the browser to the context
  //    the user was last in. example: user creates a class, user should be
  //    returned to the class they were in when completing the creation action
  $redirect = false;  //tells if we are going to redirect or usual routing
  $controller;        //used to store the controller defenition
  $action;            //used to store the action defenition
  $returnto;          //used later to redirect to appropriate context

  if(isset($_SESSION['returnto']))
  {
    $redirect = true;
  }
  //pulls session redirect information then clears them
  if($redirect)
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
  //or just go straight to the initial page
  else
  {
    $controller = 'pages';
    $action = 'index';
  }

  require_once('views/layout.php'); //pulls in our layout file
?>
