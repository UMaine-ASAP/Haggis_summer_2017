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
      $criterias = Criteria::all()[1];

      $criteriaList = "<datalist id='criterias'>";
      $criteriaStorage="";
      foreach($criterias as $c)
      {
        $criteriaList .= "<option value='".$c->title."'>";
        $criteriaStorage .= "<input type='hidden' id='".$c->title."' value='".$c->description."'>";
      }
      $criteriaList .="</datalist>";

      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }
      $class;
      $assignments;
      $classID;
      if(isset($_SESSION['token']))
      {
        if(isset($_SESSION['returnto']))
        {
          $classID = $_SESSION['returnto'];
          unset($_SESSION['returnto']);
        }
        else
        {
          $classID = $_GET['classID'];
        }
        $assignments = Assignment::classID($classID)[1];
        $class = Klass::classid($classID)[1];
      }
      $status = 'none';
      if(User::checkAdmin($_SESSION['token'])[1])
      {
          $status = 'admin';
      }
      else
      {
        $status='user';
      }
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
