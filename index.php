<?php

  session_start();

  if(true)
  {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
  }

  require_once('connection.php');

  if(isset($_GET['controller']) && isset($_GET['action']))
  {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
  }
  else
  {
    $controller = 'pages';
    $action = 'index'; //Redirect this back to index.php at root when event functionality is added.
  }
  require_once('views/layout.php');
?>
