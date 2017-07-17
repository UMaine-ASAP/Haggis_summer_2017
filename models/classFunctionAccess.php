<?php
require_once('models/class/archiveClass.php');
require_once('models/class/getUserbyClass.php');
require_once('models/class/insertClass.php');
require_once('models/class/updateClass.php');
require_once('models/class/joinClass.php');


class ClassFunctions
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
    return  '<li><a href="?controller=class&action=archiveClass">ArchiveClass</a></li>'.
            '<li><a href="?controller=class&action=getUserbyClass">Users by Class</a></li>'.
            '<li><a href="?controller=class&action=insertClass">Add a Class</a></li>'.
            '<li><a href="?controller=class&action=updateClass">Edit a Class</a></li>'.
            '<li><a href="?controller=class&action=joinClass">Join a Class</a></li>';
  }
}
?>
