<?php

class UserController
{
  function register()
  {
    echo "<form action='?controller=user&action=insertUser' method='post'>";
    echo "<input type='text' name='firstname' placeholder='First Name'> ";
    echo "<input type='text' name='middleinitial' placeholder='Middle Initial'> ";
    echo "<input type='text' name='lastname' placeholder='Last Name'><br>";
    echo "<input type='text' name='email' placeholder='E-Mail'><br>";
    echo "<input type='text' name='password' placeholder='Password'><br>";
    echo "<input type='submit' value='Add User'>";
    echo "</form>";
  }

  function insertUser()
  {
    echo User::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['password']);
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
    echo $code;
  }

  function passwordResetRequest(){
      User::sendResetEmail("jacob.hall1@maine.edu");
  }
}



?>
