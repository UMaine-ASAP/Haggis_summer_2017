<?php

class UserFunctionAccess
{
  public $type;
  public $user = array();
  public $group = array();
  public $class = array();
//=================================================================================== STRUCT
    public function __construct($typeData, $userData, $groupData, $classData)
    {
      $this->type = $typeData;
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
      $type;
      switch($type)
      {
        case "anon":
          $type = 'anon';
          break;
        case "user":
          $type = 'user';
          break;
        case "admin":
          $type = 'admin';
          $userd[] = array('controller' => 'user', 'action' => 'editUser',  'name' => 'Edit User');
          $userd[] = array('controller' => 'user', 'action' => 'index',     'name' => 'List Users');
          $userd[] = array('controller' => 'user', 'action' => 'delete',    'name' => 'Delete User');

          $groupd[] = array('controller' => 'group', 'action' => 'create',  'name' => 'Create Group');
          $groupd[] = array('controller' => 'group', 'action' => 'index',   'name' => 'List Groups');

          $classd[] = array('controller' => 'class', 'action' => 'archiveClass',  'name' => 'Archive Class');
          $classd[] = array('controller' => 'class', 'action' => 'getUserbyClass','name' => 'Get Users in Class');
          $classd[] = array('controller' => 'class', 'action' => 'insertClass',   'name' => 'Create Class');
          $classd[] = array('controller' => 'class', 'action' => 'updateClass',   'name' => 'Update Class');
          $classd[] = array('controller' => 'class', 'action' => 'listCourses',   'name' => 'List Classes');
          $classd[] = array('controller' => 'class', 'action' => 'joinClass',     'name' => 'Join Class');
          break;
      }
      return new UserFunctionAccess($type, $userd, $groupd, $classd);
    }
}

?>
