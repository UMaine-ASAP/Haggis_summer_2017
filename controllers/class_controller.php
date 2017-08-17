<?php

class ClassController
{
//=================================================================================== INDEX
  public function index()
  {
    echo "index";
  }
//=================================================================================== ARCHIVE CLASS
  public function archiveClass()
  {
    echo "archiveClass";
  }
//=================================================================================== GET USER BY CLASS
  public function getUserbyClass()
  {
    echo "GetUserByClass";
  }
//=================================================================================== INSERT CLASS
  public function insertClass()
  {
    $message='';
    $courseID='';
    $courselisting = Course::all()[1];
    $classID;
    if(isset($_POST['token']))
    {
      $courestitle ='';
      $coursecode='';
      $coursedescription='';
      if($_POST['newCourse'] == "yes")
      {
        $coursetitle=$_POST['coursetitle'];
        $coursedescription = $_POST['coursedescription'];
        $courseCode = $_POST['coursecode'];
        $courseID = Course::create($coursetitle,$courseCode,$coursedescription)[1];
        if($courseID[0] != 1)
        {
          $message = "Error Code ".$courseID[0]." : " . $courseID[1];
        }
      }
      else
      {
        $course = Course::id($_POST['courselisting'])[1];
        $courseID = $_POST['courselisting'];
        $coursetitle= $course->title;
        $coursecode = $course->code;
        $coursedescription = $course->description;
      }
      $outcome = Klass::create($courseID,$_POST['starttime'],$_POST['endtime'],$_POST['startdate'],$_POST['enddate'],$_POST['classtitle'],$_POST['classdescription'],$_POST['location'],$_POST['classcode']);
      if($outcome[0] != 1)
        $_SESSION['message'] = "Error Code " .$outcome[0]." : ".$outcome[1];
      else
      {
        Klass::associateWithDay($outcome[1], $_POST['sessiondays']);
        $userID = User::getID($_SESSION['token'])[1];
        $message = Klass::joinClass($userID, $outcome[1]);
      }
    }
    //$_SESSION['message'] = "Class Successfully Added";
    header('Location: index.php');
  }
//=================================================================================== JOIN CLASS
  public function joinClass()
  {
    if(isset($_POST['class']))
    {
      $userID = User::getID($_SESSION['token'])[1];
      $message = Klass::joinClass($userID, $_POST['class'])[1];
    }
    else
      $courses = Course::all()[1];
    require_once('views/class/joinClass.php');
  }
//=================================================================================== UPDATE CLASS
  public function updateClass()
  {
    echo "updateClass";
  }
//=================================================================================== LIST COURSES
  public function listCourses()
  {
    $courses = Course::all()[1];
    require_once('views/class/listCourses.php');
  }
//=================================================================================== VIEW CLASS
  public function viewClass()
  {
    
  }


}
