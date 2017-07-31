
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
        $thisUser = User::id($user);
        if($thisUser[0] == 1)
        echo $thisUser[1]->firstName." ".$thisUser[1]->lastName."<br>";
        else
        echo $thisUser[0]. " " . $thisUser[1];
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
