<?php

class MobileController
{
//=================================================================================== INDEX
    public function index()
    {
      require_once('views/mobile/index.php');
    }
//=================================================================================== LOGIN PAGE
    public function login()
    {
      require_once('views/mobile/login.php');
    }
//=================================================================================== REGISTRATION PAGE
    public function register()
    {
      require_once('views/mobile/register.php');
    }
//=================================================================================== CLASSES PAGE
    public function classes()
    {
      if(isset($_SESSION['token']))
      {
        $classes = Klass::userClasses($_SESSION['token'])[1];
        $courselisting = Course::all()[1];
      }

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
      }
      $status = 'user';                                   //checks for admin or user status
      require_once('views/mobile/classes.php');
    }
//=================================================================================== JOIN CLASS FUNCTION
    public function joinClass()
    {
      if(isset($_POST['joinCode']))
      {
        $userID = User::getID($_SESSION['token'])[1];
        $_SESSION['message'] = Klass::joinClass($userID, $_POST['joinCode'])[1];
      }
      else
        $courses = Course::all()[1];
      MobileController::classes();
    }
}

?>
