<?php

class UserController
{
//=================================================================================== REGISTER
  function register()
  {
      if(isset($_POST['firstname']))
      {
        $out='';
        $outcome = User::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['new-password'],$_POST['profcode']);
          switch($outcome[0])
          {
            case '1':
              $out = $outcome[1];
              break;
            case '2':
              $out = $outcome[1]." <a id='resetPassword' class='popupmaker' href='#'>Forgot Password?</a>";
              break;
          }
          $_SESSION['message'] = $out;
      }
      header('Location: index.php');
  }
//=================================================================================== LOGIN
  function login()
  {
    if(isset($_POST['email']))
    {
      $outcome =  User::login($_POST['email'], $_POST['current-password']);
      if($outcome[0] != 1)
      {
        $_SESSION['message'] = $outcome[1];
        if ($_GET['mobile']) {
          header('Location: index.php?controller=mobile&action=login');
        } else {
          header('Location: index.php');
        }
      }
      else
      {
        $UserData = $outcome[1];
        $_SESSION['firstName'] = $UserData[0];
        $_SESSION['lastName'] = $UserData[1];
        $_SESSION['middleInitial'] = $UserData[2];
        $_SESSION['token'] = $UserData[3];
        echo("<script>location.href = 'index.php';</script>");
        // header('Location: index.php');
      }
    }
  }
//=================================================================================== LOGOUT
  function logout()
  {
    if(isset($_SESSION['token']))
      User::logout($_SESSION['token']);
    session_unset();													//unsets all Session variables effecitvly logging the user out of current session
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
      if($_POST['new-password'] == $_POST['passwordConfirm'])
      {
        $outcome = User::resetPassword($code, $_POST["new-password"]);
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

    if (isset($_POST['email']))
    {
      $outcome = User::sendResetEmail($_POST['email']);
      $_SESSION['message'] = $outcome[1];
      header('Location: index.php');
    }
  }
//=================================================================================== EMAIL CONFIRMATION
  function emailConfirmation(){
    $code = $_GET['code'];
    $outcome = User::confirmEmail($code);
    $_SESSION['message'] = $outcome[1];
    header('Location: index.php');
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
