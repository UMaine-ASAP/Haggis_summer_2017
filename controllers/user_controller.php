<?php

class UserController
{
  function register()
  {
    echo "<input type='text' name='firstname'>";
    echo "<input type='text' name='lastname'>";
    echo "<input type='text' name='middleinitial'>";
    echo "<input type='text' name='email'>";
    echo "<input type='text' name='password'>";
  }

  function insertUser()
  {
    echo User::create($_POST['firstname'], $_POST['lastname'], $_POST['middleinitial'], $_POST['email'], $_POST['password']);
  }

  function index()
  {
    $results = User::all();
    foreach($results as $result)
    {
      echo $result['id']." ".$result['firstName']." ".$result['lastName'];
    }
  }
}



?>
