<?php

class UserController
{
//=================================================================================== REGISTER
  function register()
  {
      $message = "";
      $firstName = "";
      $middleInitial = "";
      $lastName = "";
      $email = "";

      $passwordsMatch = false;
      if(isset($_POST['firstname']))
      {
        $firstName = $_POST['firstname'];
        $middleInitial = $_POST['middleinitial'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        if($_POST['password'] == $_POST['passwordconfirm'])
          $passwordsMatch = true;

        if($passwordsMatch)
        {
          $outcome = User::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['password']);
          switch($outcome[0])
          {
            case '1':
              $message = $outcome[1];
              $firstName = $middleInitial = $lastName = $email = "";
              break;
            case '2':
              $message = $outcome[1]." <a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a> or <a href='?controller=user&action=passwordResetRequest'>Sign-in</a>";
              break;
          }
        }
        else
        {
          $message = "Passwords do not match";
        }
      }
      require_once('views/user/userRegistration.php');
  }
//=================================================================================== LOGIN
  function login()
  {
    if(isset($_POST['email']))
    {
      $outcome =  User::login($_POST['email'], $_POST['password']);
      if($outcome[0] != 1)
      {
        $_SESSION['message'] = $outcome[1];
        header('Location: index.php');
      }
      else
      {
        header('Location: index.php');
      }
    }
  }
//=================================================================================== LOGOUT
  function logout()
  {
    User::logout();
    header('Location: index.php');
  }
//=================================================================================== EDIT USER
  function editUser()
  {
    $userSelected = false;
    $userEdited = false;
    $selectedUser = "";
    $userList = User::all()[1];
    if(isset($_POST['user']))
    {
      $userSelected = true;
      $selectedUser = User::id($_POST['user'])[1];
    }
    else if(isset($_POST['firstname']))
    {
      User::update($_POST['firstname'],$_POST['lastname'],$_POST['middleinitial'],$_POST['email'],$_POST['usertype'],$_POST['userid']);
      $userSelected = false;
      $userEdited = true;
      $userList = User::all()[1];
    }
    require_once('views/user/editUser.php');
  }
//=================================================================================== DELETE
  function delete()
  {
    $message = "Select a User";
    $userSelected = false;
    $userEdited = false;
    $selectedUser = "";
    $userList = User::all()[1];
    if(isset($_POST['user']))
    {
      $message = "Confirm deletion of user";
      $userSelected = true;
      $selectedUser = User::id($_POST['user'])[1];
    }
    else if(isset($_POST['confirm']))
    {
      if($_POST['confirm'] == "yes")
      {
        $message = "User has been deleted";
        User::delete($_POST['userid']);
        $userSelected = false;
        $userEdited = true;
        $userList = User::all()[1];
      }
      else
      {
        $message = "User has not been deleted";
        $userSelected = false;
        $userEdited = false;
      }
    }
    require_once('views/user/userDelete.php');
  }
//=================================================================================== INDEX
  function index()
  {
    $results = User::all()[1];
    require_once('views/user/viewUsers.php');
  }
//=================================================================================== PASSWORD RESET
  function passwordReset(){
    $code = $_GET['code'];
    $message = "";

    if (isset($_POST['passwordConfirm']))
    {
      if($_POST['password'] == $_POST['passwordConfirm'])
      {
        $outcome = User::resetPassword($code, $_POST["password"]);
        if($outcome[0] == 1)
        {
          $message = $outcome[1];
          echo "<script> if(confirm('".$message."')) document.location = 'index.php'</script>";
        }
      }
      else
      {
        $message = "Your passwords do not match. Please try again.";
      }
    }
    require_once('views/user/passwordReset.php');

  }
//=================================================================================== PASSWORD RESET REQUEST
  function passwordResetRequest(){
    require_once('views/user/passwordResetRequest.php');
    if (isset($_POST['submit'])){
      User::sendResetEmail($_POST['email']);
    }
  }
//=================================================================================== EMAIL CONFIRMATION
  function emailConfirmation(){
    $code = $_GET['code'];
    $outcome = User::confirmEmail($code);
    $message = $outcome[1];
    require_once('views/pages/index.php');
  }
//=================================================================================== SEND EMAIL CONFIRMATION
  function sendEmailConfirmation()
  {
    $email = $_GET['email'];
    $outcome = User::sendConfirmEmail($email);
    $message = $outcome[1];
    require_once('views/user/login.php');
  }
}



?>
