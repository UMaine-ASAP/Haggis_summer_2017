<?php

class ClassController
{
  public function index()
  {
    echo "index";
  }

  public function archiveClass()
  {
    echo "archiveClass";
  }

  public function getUserbyClass()
  {
    echo "GetUserByClass";
  }

  public function insertClass()
  {
    $message='';
    $courseID='';
    $courselisting = PullCourse::all();
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
        $courseID = AddCourse::insert($coursetitle,$coursecode,$coursedescription);
      }
      else
      {
        $course = PullCourse::id($_POST['courselisting']);
        $courseID = $_POST['courselisting'];
        $coursetitle=$course->title;
        $coursecode = $course->code;
        $coursedescription = $course->description;
      }
      $message = AddClass::insert($courseID,$_POST['sessiontime'],$_POST['classtitle'],$_POST['classdescription'],$_POST['location']);
    }
    require_once('views/class/insertClass.php');
  }

  public function joinClass()
  {
    require_once('views/class/joinClass.php');
  }

  public function updateClass()
  {
    echo "updateClass";
  }

  public function listCourses()
  {
    $courses = PullCourse::all();
    $courselist="";
    foreach($courses as $course)
    {
      $classlist ="";
      foreach($course->classes as $class)
      {
        $classlist = $classlist.$class->title."<br>";
      }
      $courselist = $courselist.
                    "<tr>".
                    "<td>".$course->id."</td>".
                    "<td>".$course->title."</td>".
                    "<td>".$course->code."</td>".
                    "<td>".$course->description."</td>".
                    "<td>".$classlist."</td>".
                    "</tr>";
    }
    $courselist =  "<table>".
          "<tr>".
          "<th>ID</th>".
          "<th>Title</th>".
          "<th>Course Code</th>".
          "<th>Description</th>".
          "<th>Classes</th>".
          "</tr>".
          $courselist.
          "</table>";
    require_once('views/class/listCourses.php');

  }


}
