
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
      foreach($group->userIDs as $user)
      {
        $thisUser = User::id($user)[1];
        echo $thisUser->firstName. " ". $thisUser->lastName."<br>";
      }
    }
    require_once('views/group/index.php');
  }
//=================================================================================== CREATE
  public function create()
  {
    $message ="";
    $NumofGroups = 2;
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
        Group::create("1", $userIDs);
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
//=================================================================================== ERROR
  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
