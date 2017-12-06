<?php

class PagesController
{
//=================================================================================== INDEX
    public function index()
    {
      $message = "";

      $events = Event::getActive()[1];

      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }
      $status = 'none';
      if(isset($_SESSION['token']))
      {
        $classes = Klass::userClasses($_SESSION['token'])[1];
        $courselisting = Course::all()[1];
        if(User::checkAdmin($_SESSION['token'])[1])
        {
            $status = 'admin';
        }
        else
        {
          $status='user';
        }
      }
      require_once('views/pages/index.php');
    }
//=================================================================================== CLASSES
    public function classes()
    {
      $message = "";
      $assignments;
      $classID;
      $allusers = User::all()[1];
      if(isset($_SESSION['returnto']))
      {
        $classID = $_SESSION['returnto'];
        unset($_SESSION['returnto']);
      }
      else
        $classID = Klass::joinCode($_GET['classcode']);
      $assignments = Assignment::classID($classID)[1];  //pulls assignments for the relevent class
      $status = 'user';                                   //checks for admin or user status
      $class = Klass::classid($classID)[1];
      $students = User::klass($classID)[1];
      if(User::checkAdmin($_SESSION['token'])[1])
          $status = 'admin';
      require_once('views/pages/classes.php');
    }
//=================================================================================== ASSIGNMENTS
    public function assignmentCreation()
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
