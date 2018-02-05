
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
    ?>

    <form action='?controller=user&action=login' method='post'>
      <input class='standard' type='email' name='email' placeholder='Email Address'>
      <input class='standard' type='password' name='current-password' placeholder='Password'>
      <input  class='standard submitlogin' type='submit' value='Login'><br>
    </form>
    <a  id='registerUser' onclick="createPopup('registerUser')">Register</a>
    <a  id ='resetPassword' onclick="createPopup('resetPassword')" href='#'>Forgot Password?</a>


    <?php
  }
?>
  <div id='registerUser' class='popup'><?php require_once('views/user/userRegistration.php');?></div>
  <div id='resetPassword' class='popup'><?php require_once('views/user/passwordResetRequest.php');?></div>
