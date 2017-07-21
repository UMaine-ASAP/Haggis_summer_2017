
<?php

class GroupController
{
  public function index()
  {
    $groupList = GroupPull::all();
    foreach($groupList as $group)
    {
      echo "<br>Group Set ". $group->studentGroupID."<br>";
      foreach($group->userIDs as $user)
      {
        $thisUser = UserPull::id($user);
        echo $thisUser->firstName. " ". $thisUser->lastName;
      }
    }
    require_once('views/group/index.php');
  }

  public function create()
  {
    $message ="";
    $userList = UserPull::all();
    if(isset($_POST['labels']))
    {
      foreach($_POST['labels'] as $lable)
      {
        $userIDs = array();
        foreach($_POST[$lable] as $element)
        {
          $userIDs[] = $element;
        }
        GroupInsert::group("1", $userIDs);
      }
    }

    require_once('views/group/createGroup.php');
  }

  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
