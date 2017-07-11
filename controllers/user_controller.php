<?php

class UserController
{
  function register()
  {
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


  function insertUser()
  {
    echo User::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['password']);
  }

  function editUser()
  {
    $userSelected = false;
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
    }
    require_once('views/user/editUser.php');
  }

  function index()
  {
    $results = User::all();
    echo sizeof($results)."<br>";
    foreach($results as $result)
    {
      echo $result->id." ".$result->firstName. "<br>";
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
}



?>
