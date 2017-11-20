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
      $message = "";

      if(isset($_SESSION['message']))
      {
        $message = $_SESSION['message'];
        $_SESSION['message'] = "";
      }
      require_once('views/mobile/login.php');
    }
//=================================================================================== REGISTRATION PAGE
    public function register()
    {
      require_once('views/mobile/register.php');
    }
//=================================================================================== FORGOT PASSWORD PAGE
    public function forgotPassword()
    {
      require_once('views/mobile/forgotPassword.php');
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
//=================================================================================== DISPLAY ASSIGNMENTS
    public function assignments()
    {
      $message = "";
      $assignments;
      $classID;
      if(isset($_SESSION['returnto']))
      {
        $classID = $_SESSION['returnto'];
        unset($_SESSION['returnto']);
      }
      else
        $classID = $_GET['classID'];
      $assignments = Assignment::classID($classID)[1];  //pulls assignments for the relevent class
      $status = 'user';                                   //checks for admin or user status
      $class = Klass::classid($classID)[1];
      $students = User::klass($classID)[1];
      if(User::checkAdmin($_SESSION['token'])[1])
          $status = 'admin';
      require_once('views/mobile/assignments.php');
    }
//=================================================================================== DISPLAY PROJECTS
    public function projects()
    {
      $projects = Project::assignment($_GET['assignmentID'])[1];
      require_once('views/mobile/projects.php');
    }
//=================================================================================== EVALUATE PROJECT
    public function evaluate()
    {
      $projectID;
      if(isset($_POST['evalfor']))
      {
        $userid = User::getID($_SESSION['token'])[1];
        $projectID = $_POST['evalfor'];
        for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
        {
          Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $projectID, $userid )[1];
        }
        header('Location: index.php?controller=mobile&action=responses&id='.$projectID);
      }
      else
      {
        $projectid = $_GET['projectID'];
        $criteria = Criteria::assignmentID($_GET['assignmentID'])[1];
        require_once('views/mobile/evaluation.php');
      }
    }
//=================================================================================== RESPONSES PROJECT
    public function responses()
    {
      $projectid = $_GET['id'];
      $project = Project::id($projectid)[1];
      $projectresponses = Evaluate::projectID($projectid)[1];
      $cID = array();
      $cNames = array();
      $cAvg = array();
      $cComments = array();

      foreach($projectresponses as $r)
      {
        $temp = Criteria::id($r->criteriaID)[1];
        $check = in_array($temp->id, $cID);
        $user = $r->author;
          if( $check != false)
          {
            $index = array_search($temp->id, $cID);
            $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
            $cComments[$index][] = $r->comment." --".$user->firstName." ".$user->lastName;
          }
          else
          {
            $cID[] = $temp->id;
            $cNames[] = $temp->title;
            $cAvg[] = $r->rating;
            $cComments[] = array($r->comment." --".$user->firstName." ".$user->lastName);
          }
      }
      // The HTML is at this location  |
      //                              \/
      require_once("views/mobile/responses.php");
    }
}

?>
