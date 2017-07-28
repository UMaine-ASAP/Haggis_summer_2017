<?php

class SessionController
{
  public static function menuBuilder()
  {
    $loginStatus ="";
    $userFunctions ="";
    if(isset($_SESSION['token']))
    {
      $loginStatus = "Logged in as ". $_SESSION['firstName'] ." ". $_SESSION['middleInitial'] ." ". $_SESSION['lastName']."<br><a href='?controller=user&action=logout'>Logout</a>";
      if(User::checkAdmin($_SESSION['token']))
      {
        $userFunctions = UserFunctionAccess::getFunctions("admin");
      }
      else
      {
        $userFunctions = UserFunctionAccess::getFunctions("user");
      }
    }
    else
    {

      $loginStatus = "<form action='?controller=user&action=login' method='post'>".
                      "<input type='email' name='email' placeholder='Email Address'>".
                      "<input type='password' name='password' placeholder='Password'><br>";
      if(isset($_SESSION['message']))
      {
        $loginStatus .= "<div class='error'>".$_SESSION['message']."</div>";
      }
      $loginStatus .= "<a href='?controller=user&action=register'>Register</a>".
                      "<a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a>".
                      "<input type='submit' value='Login'>".
                      "</form>";
      $userFunctions = UserFunctionAccess::getFunctions("anon");
    }
    $data = array($loginStatus, $userFunctions);
    return array("1",$data);
  }
}
