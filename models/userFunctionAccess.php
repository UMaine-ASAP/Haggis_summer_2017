<?php
require_once('models/user/user.php');
require_once('models/user/pull.php');
require_once('models/user/update.php');
require_once('models/user/checkAdmin.php');
require_once('models/user/creation.php');
require_once('models/user/delete.php');
require_once('models/user/email.php');
require_once('models/user/password.php');
require_once('models/user/session.php');


class UserFunctions
{
  public static function anon()
  {
    return  '<li><a href="?controller=user&action=login">Login</a></li>'.
            '<li><a href="?controller=user&action=register">Register</a></li>'.
            '<li><a href="?controller=user&action=passwordResetRequest">Forgot Password?</a></li>';
  }

  public static function user()
  {
    return  '<li><a href="?controller=user&action=logout">Logout</a></li>';
  }

  public static function admin()
  {
    return  '<li><a href="?controller=user&action=logout">Logout</a></li>'.
            '<li><a href="?controller=user&action=editUser">Edit User</a></li>'.
            '<li><a href="?controller=user&action=index">List Users</a></li>'.
            '<li><a href="?controller=user&action=delete">Delete a User</a></li>';
  }
}
?>
