<?php
  require_once('models/user.php');
  require_once('models/userFunctionAccess.php');
  if(isset($_SESSION['token']))
  {
    echo  "Logged in as ".  $_SESSION['firstName'] ." ".$_SESSION['middleInitial'] ." ". $_SESSION['lastName'].
          "<br><a href='?controller=user&action=logout'>Logout</a>";

  }
  else
  {
    $loginForm =  "<form action='?controller=user&action=login' method='post'>".
                  "<input type='email' name='email' placeholder='Email Address'>".
                  "<input type='password' name='password' placeholder='Password'><br>";
    if(isset($_SESSION['message']))
    {
      $loginForm .= "<div class='error'>".$_SESSION['message']."</div>";
    }
    $loginForm .= "<a href='?controller=user&action=register'>Register</a>".
                    "<a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a>".
                    "<input type='submit' value='Login'>".
                    "</form>";
    echo $loginForm;
  }
?>
