
<?php

class GroupController
{
//=================================================================================== INDEX
  public function index()
  {
    $groupList = Group::all()[1];
    foreach($groupList as $group)
    {
      echo "<br><h3>Group Set ". $group->studentGroupID."</h3><br>";
      foreach($group->users as $user)
      {
        echo $user->firstName." ".$user->lastName."<br>";
      }
    }
    require_once('views/group/index.php');
  }
//=================================================================================== CREATE
  public function create()
  {
    $message ="";
    $NumofGroups = 3;
    $userList = User::all()[1];
    if(isset($_POST['labels']))
    {
      $NumofGroups = sizeof($_POST['labels']);
      foreach($_POST['labels'] as $lable)
      {
        $userIDs = array();
        foreach($_POST[$lable] as $element)
        {
          $userIDs[] = $element;
        }
         $message = Group::create("1", $userIDs)[1];
      }
    }
    require_once('views/group/createGroup.php');
    if(isset($_POST['labels']))
    {
      $counter = 0;
      foreach($_POST['labels'] as $lable)
      {
        foreach($_POST[$lable] as $element)
        {
          echo "<script type ='text/javascript'> move(".$element.",".$counter."); </script><br>";
        }
        $counter = $counter+1;
      }
    }
  }
//=================================================================================== EDIT
  public function edit()
  {
      $projectIDs;
      $projectID;
      if(isset($_POST['projectID']))
      {
        $groups = Group::getByProjectID($_POST['projectID'])[1];
      }
      else
      {
        $projectIDs = Group::getProjectIDs()[1];
      }
      require_once('views/group/editGroup.php');
  }

//=================================================================================== ERROR
  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
