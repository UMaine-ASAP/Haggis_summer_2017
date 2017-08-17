<?php

class PagesController
{
//=================================================================================== INDEX
    public function index()
    {
      $message = "";
      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }
      if(isset($_SESSION['token']))
      $classes = Klass::userClasses($_SESSION['token'])[1];
      $courselisting = Course::all()[1];
      require_once('views/pages/index.php');
    }
//=================================================================================== CLASSES
    public function classes()
    {
      $message = "";
      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }
      $classes;
      $assignments;
      if(isset($_SESSION['token']))
      if(isset($returnto))
      {
        $assignments = Assignment::classID($returnto)[1];
        $class = Klass::classid($returnto)[1];
      }
      else
      {
        $assignments = Assignment::classID($_GET['classID'])[1];
        $class = Klass::classid($_GET['classID'])[1];
      }

      require_once('views/pages/classes.php');
    }
//=================================================================================== ASSIGNMENTS
    public function assignments()
    {
      require_once('views/pages/assignments.php');
    }
//=================================================================================== GROUPS
    public function groups()
    {
      require_once('views/pages/groups.php');
    }
//=================================================================================== ERROR
    public function error()
    {
      require_once('views/pages/error.php');
    }
}

?>
