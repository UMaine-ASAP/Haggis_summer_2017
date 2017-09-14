
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
    $loginForm .= "<a class='popupmaker' id='registerUser' href='#'>Register</a>".
                    "<a class='popupmaker' id ='resetPassword' href='#'>Forgot Password?</a>".
                    "</form>";
    echo $loginForm;
  }
?>
  <div id='registerUser' class='popup'><?php require_once('views/user/userRegistration.php');?></div>
  <div id='resetPassword' class='popup'><?php require_once('views/user/passwordResetRequest.php');?></div>
