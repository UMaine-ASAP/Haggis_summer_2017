<?php

class PagesController
{
//=================================================================================== INDEX
    public function index()
    {
      $message = "";
      $status = 'none';
      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }
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
      if(isset($_SESSION['token']))
        if(isset($_SESSION['returnto']))
        {
          $assignments = Assignment::classID($_SESSION['returnto'])[1];
          $class = Klass::classid($_SESSION['returnto'])[1];
          unset($_SESSION['returnto']);
        }
        else
        {
          $assignments = Assignment::classID($_GET['classID'])[1];
          $class = Klass::classid($_GET['classID'])[1];
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
