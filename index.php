<?php

  session_start();

  if(true)
  {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
  }

  require_once('connection.php');

  $source = 0;
  if(isset($_GET['controller']) && isset($_GET['action']))
  {
    $source = 2;
  }
  if(isset($_SESSION['returnto']))
  {
    $source = 1;
  }
  $controller;
  $action;
  $returnto;
  switch($source)
  {
    case 1:
    {
      $controller = $_SESSION['controller'];
      $action = $_SESSION['action'];
      break;
      unset($_SESSION['controller']);
      unset($_SESSION['action']);

    }
    case 2:
    {
      $controller = $_GET['controller'];
      $action = $_GET['action'];
      break;
    }
    default:
    {
      $controller = 'pages';
      $action = 'index';
      break;
    }
  }
  require_once('views/layout.php');
?>
