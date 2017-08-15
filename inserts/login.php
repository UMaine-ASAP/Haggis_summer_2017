<?php
  require_once('models/user.php');
  require_once('models/userFunctionAccess.php');
  if(isset($_SESSION['token']))
  {
    echo "Hello ". $_SESSION['firstName']." ".$_SESSION['lastName'];
    echo  "<a href='?controller=user&action=logout'>log out</a>";

  }
  else
  {
    $loginForm =  "<form action='?controller=user&action=login' method='post'>".
                  "<input class='standard' type='email' name='email' placeholder='Email Address'>".
                  "<input class='standard' type='password' name='password' placeholder='Password'>".
                  "<input class='standard' type='submit' value='Login'><br>";
    if(isset($_SESSION['message']))
    {
      $loginForm .= "<div class='error'>".$_SESSION['message']."</div>";
    }
    $loginForm .= "<a href='?controller=user&action=register'>Register</a>".
                    "<a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a>".
                    "</form>";
    echo $loginForm;
  }
?>
