
<?php

class GroupController
{
  public function index()
  {
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
        GroupInsert::group("0", $userIDs);
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
