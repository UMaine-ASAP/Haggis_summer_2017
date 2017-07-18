<?php
require_once('models/group/group.php');
// require_once('models/group/.php');
// require_once('models/group/.php');
// require_once('models/group/.php');
// require_once('models/group/.php');
// require_once('models/group/.php');
// require_once('models/group/.php');
// require_once('models/group/.php');
// require_once('models/group/.php');



class GroupFunctions
{
  public static function anon()
  {
    return  '';
  }

  public static function user()
  {
    return  '';
  }

  public static function admin()
  {
    return  '<ul>'.
            '<li><a href="?controller=group&action=create">Create Group</a></li>'.
            '<li><a href="?controller=group&action=index">All Groups</a></li>'.
            '</ul>';
  }

}
?>
