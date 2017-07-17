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
    if(isset($_POST['token']))
    {
      $message = AddClass::insert($_POST['title'],$_POST['courseid'],$_POST['sessiontime'],$_POST['description'],$_POST['location']);
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


}
