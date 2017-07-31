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
          switch($outcome)
          {
            case '1':
              $message = "Successfully registered ".$firstName." ".$lastName;
              $firstName = $middleInitial = $lastName = $email = "";
              break;
            case '2':
              $message = "The email '".$email."' is already registered. <a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a> or <a href='?controller=user&action=passwordResetRequest'>Sign-in</a>";
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
      $_SESSION['message'] = User::login($_POST['email'], $_POST['password']);
    }
    header('Location: index.php');
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
    $userList = User::all();
    if(isset($_POST['user']))
    {
      $userSelected = true;
      $selectedUser = User::id($_POST['user']);
    }
    else if(isset($_POST['firstname']))
    {
      User::update($_POST['firstname'],$_POST['lastname'],$_POST['middleinitial'],$_POST['email'],$_POST['usertype'],$_POST['userid']);
      $userSelected = false;
      $userEdited = true;
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
    $userList = User::all();
    if(isset($_POST['user']))
    {
      $message = "Confirm deletion of user";
      $userSelected = true;
      $selectedUser = User::id($_POST['user']);
    }
    else if(isset($_POST['confirm']))
    {
      if($_POST['confirm'] == "yes")
      {
        $message = "User has been deleted";
        User::delete($_POST['userid']);
        $userSelected = false;
        $userEdited = true;
        $userList = User::all();
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
    $results = User::all();
    echo sizeof($results)." Users are registered.<br>";
    echo "<table>";
    echo "<tr><th>UserID</th><th>UserType</th><th>First Name</th><th>LastName</th>";
    foreach($results as $result)
    {
      echo "<tr><td>".$result->id."</td><td>".$result->usertype ."</td><td>".$result->firstName."</td><td>".$result->lastName. "</td></tr>";
    }
    echo "</table>";
  }
//=================================================================================== PASSWORD RESET
  function passwordReset(){
    $code = $_GET['code'];
    $message = "";

    if (isset($_POST['passwordConfirm']))
    {
      if($_POST['password'] == $_POST['passwordConfirm'])
      {
        if(User::resetPassword($code, $_POST["password"]))
        {
          $message = "Your password has been reset. Login with your new credentials.";
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
    User::confirmEmail($code);
    $message = "Email has been confirmed, you may now login";
    require_once('views/pages/index.php');
  }
//=================================================================================== SEND EMAIL CONFIRMATION
  function sendEmailConfirmation()
  {
    $email = $_GET['email'];
    User::sendConfirmEmail($email);
    $message = "Confirmation email sent";
    require_once('views/user/login.php');
  }
}



?>
