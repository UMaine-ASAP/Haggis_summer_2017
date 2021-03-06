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
      if(isset($_GET['classID'])){
          $assignmentID = $_GET['assignmentID'];
          $classID = $_GET['classID'];
          $projects = Project::assignment($assignmentID)[1];
          $type = '1';
      } else {
          $event = Event::id($_GET['eventID'])[1];
          $assignmentIDs = Event::getAssignments($event->id)[1];
          $eventProjectIDs = Event::getEventProjects($event->id)[1];
          $assignments;
          $eventProjects;
          $projectList = array();
          $eventprojectList = array();
          $type = '2';
          $eventID = $_GET['eventID'];
          foreach($assignmentIDs as $a)
          {
            $assignments =  Assignment::id($a)[1];
            foreach($assignments->projects as $p)
            {
              $projectList[] = $p;
            }
          }
          foreach($eventProjectIDs as $ep)
          {
            $eventprojectList[] = EventProject::id($ep)[1];
          }
      }
      require_once('views/mobile/projects.php');
    }
//=================================================================================== EVALUATE ANY
    public function evaluate() {

      //EVALUATION FORM LOADING
      if(isset($_GET['classID']))
      {
        $classID = $_GET['classID'];
        $assignmentID = $_GET['assignmentID']; // targetID
        $projectID = $_GET['projectID'];
        $rubric = Rubric::assignmentID($assignmentID)[1];
        $criteria = $rubric->criteriaSets;
        $type = '1';
      }
      else
      {
        $eventID = $_GET['eventID'];
        $projectID = $_GET['projectID']; // targetID
        $rubric = Rubric::eventID($eventID)[1];
        $criteria = $rubric->criteriaSets;
        $type = '2';
      }

      //EVALUATION SUBMISSION
      if(isset($_POST['evalfor']))
      {
        $projectID = $_POST['evalfor'];
        if ($type == '1') { // Test for type project vs type event
          $userid = User::getID($_SESSION['token'])[1];
          for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
          {
            Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $projectID, $userid, 1 )[1];
          }
          $direction = header("Location: index.php?controller=mobile&action=responses&classID=$classID&assignmentID=$assignmentID&id=$projectID");
        }
        else
        {
          for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
          {
            Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $eventID, -1, 2 )[1];
          }
          $direction = header("Location: index.php?controller=mobile&action=events&eventID=".$eventID);
        }
      }

        if(isset($eventID))
          $_SESSION['eventID'] = $eventID;
        require_once('views/mobile/evaluation.php');
      }


    public function eventSubmit()
    {
      $eventID = $_GET['eventID'];
      $type = 2;
      $userid = -1;
      $targetID = $_POST['evalfor'];
      for($i = 0; $i<sizeof($_POST['criteriaID']);$i++)
        echo Evaluate::submit($_POST['criteriaID'][$i], $_POST['criteriaRating'][$i], $_POST['criteriaComment'][$i], $targetID, $userid, $type )[1];
      header("Location: index.php?controller=mobile&action=events&eventID=".$eventID);
    }
//=================================================================================== RESPONSES PROJECT
    public function responses()
    {
      $classID = $_GET['classID'];
      $projectid = $_GET['id'];
      $assignmentID = $_GET['assignmentID'];
      $project = Project::id($projectid)[1];
      $projectresponses = Evaluate::projectID($projectid)[1];
      $cID = array();
      $cNames = array();
      $cAvg = array();
      $cComments = array();
      $dataout = array();

      foreach($projectresponses as $r)
      {

        $temp = CriteriaSet::id($r->criteriaID)[1][0];

        $check = in_array($temp->title, $cNames);
        $author = $r->author;
          if($check)
          {
            $index = array_search($temp->title, $cNames);
            $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
            $cComments[$index][] = "-- ".$r->comment;
          }
          else
          {
            $cID[] = $temp->id;
            $cNames[] = $temp->title;
            $cAvg[] = $r->rating;
            $cComments[] = array("-- ".$r->comment);

          }
      }
      for($i = 0; $i<sizeof($cNames);$i++)
      {
        $dataout[]= array('lable' => $cNames[$i], 'rating' => $cAvg[$i]);
      }
      // The HTML is at this location  |
      //                              \/
      require_once("views/mobile/responses.php");
    }

    public function events() {
      $events = Event::getActive()[1];
      require_once('views/mobile/events.php');
    }
}

?>
