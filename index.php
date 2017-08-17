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
  if(isset($_SESSION['controller']) && isset($_SESSION['action']))
  {
    $source = 1;
  }

  switch($source)
  {
    case 1:
    {
      $controller = $_SESSION['controller'];
      $action = $_SESSION['action'];
      $returnto = $_SESSION['returnto'];
      break;
      unset($_SESSION['controller']);
      unset($_SESSION['action']);
      unset($_SESSION['returnto']);

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
