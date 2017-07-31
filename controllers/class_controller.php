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
    if(isset($_POST['token']))
    {
      $courestitle ='';
      $coursecode='';
      $coursedescription='';
      if($_POST['newCourse'] == "yes")
      {
        $coursetitle=$_POST['coursetitle'];
        $coursecode = $_POST['coursecode'];
        $coursedescription = $_POST['coursedescription'];
        $courseID = Course::create($coursetitle,$coursecode,$coursedescription);
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
      $outcome = Klass::create($courseID,$_POST['sessiontime'],$_POST['classtitle'],$_POST['classdescription'],$_POST['location']);
      if($outcome[0] != 1)
        $message = "Error Code " .$outcome[0]." : ".$outcome[1];
      else
        $message = $outcome[1];
    }
    require_once('views/class/insertClass.php');
  }
//=================================================================================== JOIN CLASS
  public function joinClass()
  {
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


}
