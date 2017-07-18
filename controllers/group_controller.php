
<?php

class GroupController
{
  public function index()
  {
    require_once('views/group/index.php');
  }

  public function create()
  {
    $userList = UserPull::all();
    require_once('views/group/createGroup.php');
  }

  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
