<?php

class PagesController
{
//=================================================================================== INDEX
    public function index()
    {
      require_once('views/pages/index.php');
    }
//=================================================================================== CLASSES
    public function classes()
    {
      if(isset($_SESSION['token']))
      $classes = Klass::userClasses($_SESSION['token'])[1];
      echo sizeof($classes);
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
