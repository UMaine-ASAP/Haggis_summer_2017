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
      $class;
      $assignments;
      $classID;
      $idList = array();
      $NumofGroups = 3;
      $userList;

      //fetch criterias to be used in assignment creation
      $criterias = Criteria::all()[1];
      $criteriaList = "<datalist id='criterias'>";
      $criteriaStorage="";
      foreach($criterias as $c)
      {
        $criteriaList .= "<option value='".$c->title."'>";
        $criteriaStorage .= "<input type='hidden' id='".$c->title."' value='".$c->description."'>";
      }
      $criteriaList .="</datalist>";

      //Message pulling - pulls message out of the session variables if there is any message to collect
      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }

      //Post routing - checks to see if user is logged in, and directs user back to the class they were in previously
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
        $assignments = Assignment::classID($classID)[1];  //pulls assignments for the relevent class
        $class = Klass::classid($classID)[1];             //pulls class data
        $students = User::klass($classID)[1];           //pulls data for students in class
        $userList = User::klass($classID)[1];

      }
      $status = 'user';                                   //checks for admin or user status

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
