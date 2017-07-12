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
          $outcome = User::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['password']);
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
    require_once('views/user/login.php');
    if(isset($_POST['email']))
    {
      User::login($_POST['email'], $_POST['password']);
    }
  }

  function logout()
  {
    User::logout();
    require_once('views/home/index.php');
  }

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
      $data = array($_POST['firstname'],$_POST['lastname'],$_POST['middleinitial'],$_POST['email'],$_POST['usertype'],$_POST['userid']);
      User::update($data);
      $userSelected = false;
      $userEdited = true;
    }
    require_once('views/user/editUser.php');
  }

  function index()
  {
    $results = User::all();
    echo sizeof($results)." Users are registered.<br>";
    foreach($results as $result)
    {
      echo $result->id." ".$result->usertype ." ".$result->firstName." ".$result->lastName. "<br>";
    }
  }

  function passwordReset(){
    $code = $_GET['code'];
    require_once('views/user/passwordReset.php');
    if (isset($_POST['submit'])){
      User::resetPassword($code, $_POST["password"]);
    }
  }

  function passwordResetRequest(){
    require_once('views/user/passwordResetRequest.php');
    if (isset($_POST['submit'])){
      User::sendResetEmail($_POST['email']);
    }
  }

  function emailConfirmation(){
    $code = $_GET['code'];
    User::confirmEmail($code);
    $message = "Email has been confirmed, you may now login";
    require_once('views/home/index.php');
  }

  function sendEmailConfirmation()
  {
    $email = $_GET['email'];
    User::sendConfirmEmail($email);
    $message = "Confirmation email sent";
    require_once('views/user/login.php');

  }
}



?>
