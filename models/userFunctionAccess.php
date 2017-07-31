<?php

class UserFunctionAccess
{
  public $user = array();
  public $group = array();
  public $class = array();
//=================================================================================== STRUCT
    public function __construct($userData, $groupData, $classData)
    {
      $this->user = $userData;
      $this->group = $groupData;
      $this->class = $classData;
    }
//=================================================================================== GET FUNCTIONS
    public static function getFunctions($type)
    {
      $userd = array();
      $groupd = array();
      $classd = array();
      switch($type)
      {
        case "anon":
          break;
        case "user":
          break;
        case "admin":
          $userd[] = "<a href='?controller=user&action=editUser'>Edit User</a>";
          $userd[] = "<a href='?controller=user&action=index'>List Users</a>";
          $userd[] = "<a href='?controller=user&action=delete'>Delete a User</a>";

          $groupd[] = "<a href='?controller=group&action=create'>Create Group</a>";
          $groupd[] = "<a href='?controller=group&action=index'>All Groups</a>";

          $classd[] = "<a href='?controller=class&action=archiveClass'>ArchiveClass</a>";
          $classd[] = "<a href='?controller=class&action=getUserbyClass'>Users by Class</a>";
          $classd[] = "<a href='?controller=class&action=insertClass'>Add a Class</a>";
          $classd[] = "<a href='?controller=class&action=updateClass'>Edit a Class</a>";
          $classd[] = "<a href='?controller=class&action=listCourses'>Show all Courses</a>";
          $classd[] = "<a href='?controller=class&action=joinClass'>Join a Class</a>";
          break;
      }
      return new UserFunctionAccess($userd, $groupd, $classd);
    }
}

?>
