<?php

class UserController
{
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
          $outcome = UserCreation::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['password']);
          echo $outcome;
          if($outcome == '1')
          {
            $message = "Successfully registered ".$firstName." ".$lastName;
            $firstName = $middleInitial = $lastName = $email = "";
          }
          if($outcome == '2')
          {
            $message = "The email '".$email."' is already registered. <a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a> or <a href='?controller=user&action=passwordResetRequest'>Sign-in</a>";
          }
        }
        else
        {
          $message = "Passwords do not match";
        }
      }
      require_once('views/user/userRegistration.php');
  }

  function login()
  {

    if(isset($_POST['email']))
    {
      $message = UserSession::login($_POST['email'], $_POST['password']);
    }
    require_once('views/user/login.php');
  }

  function logout()
  {
    UserSession::logout();
    header('Location: index.php');
  }

  function editUser()
  {
    $userSelected = false;
    $userEdited = false;
    $selectedUser = "";
    $userList = UserPull::all();
    if(isset($_POST['user']))
    {
      $userSelected = true;
      $selectedUser = UserPull::id($_POST['user']);
    }
    else if(isset($_POST['firstname']))
    {
      UserUpdate::update($_POST['firstname'],$_POST['lastname'],$_POST['middleinitial'],$_POST['email'],$_POST['usertype'],$_POST['userid']);
      $userSelected = false;
      $userEdited = true;
    }
    require_once('views/user/editUser.php');
  }

  function delete()
  {
    $message = "Select a User";
    $userSelected = false;
    $userEdited = false;
    $selectedUser = "";
    $userList = UserPull::all();
    if(isset($_POST['user']))
    {
      $message = "Confirm deletion of user";
      $userSelected = true;
      $selectedUser = UserPull::id($_POST['user']);
    }
    else if(isset($_POST['confirm']))
    {
      if($_POST['confirm'] == "yes")
      {
        $message = "User has been deleted";
        UserDelete::id($_POST['userid']);
        $userSelected = false;
        $userEdited = true;
        $userList = UserPull::all();
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

  function index()
  {
    $results = UserPull::all();
    echo sizeof($results)." Users are registered.<br>";
    echo "<table>";
    echo "<tr><th>UserID</th><th>UserType</th><th>First Name</th><th>LastName</th>";
    foreach($results as $result)
    {
      echo "<tr><td>".$result->id."</td><td>".$result->usertype ."</td><td>".$result->firstName."</td><td>".$result->lastName. "</td></tr>";
    }
    echo "</table>";
  }

  function passwordReset(){
    $code = $_GET['code'];
    require_once('views/user/passwordReset.php');
    if (isset($_POST['submit'])){
      UserPassword::resetPassword($code, $_POST["password"]);
    }
  }

  function passwordResetRequest(){
    require_once('views/user/passwordResetRequest.php');
    if (isset($_POST['submit'])){
      UserPassword::sendResetEmail($_POST['email']);
    }
  }

  function emailConfirmation(){
    $code = $_GET['code'];
    UserEmail::confirmEmail($code);
    $message = "Email has been confirmed, you may now login";
    require_once('views/home/index.php');
  }

  function sendEmailConfirmation()
  {
    $email = $_GET['email'];
    UserEmail::sendConfirmEmail($email);
    $message = "Confirmation email sent";
    require_once('views/user/login.php');

  }
}



?>
