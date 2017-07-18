<?php
  class HomeController
  {
    public function index()
    {
      $userFunctions ="";
      $classFunctions = "";
      if(isset($_SESSION['token']))
      {
        $user = true;
        if(CheckAdmin::check($_SESSION['token']))
        {
          $userFunctions = UserFunctions::admin();
          $classFunctions = ClassFunctions::admin();
        }
        else
          {
            $userFunctions = UserFunctions::user();
            $classFunctions = ClassFunctions::user();
          }
        }
      else
      {
        $userFunctions = UserFunctions::anon();
        $classFunctions = ClassFunctions::anon();
      }
      $loginStatus ='';
      if(isset($user))
      {
        $loginStatus = "Logged in as ". $_SESSION['firstName'] ." ". $_SESSION['middleInitial'] ." ". $_SESSION['lastName'];
        if($user)
          $loginStatus = $loginStatus."<br>ADMIN USER";
        else
          $loginStatus = $loginStatus. "<br>NON ADMIN";
        }
      else
      {
        $loginStatus = "Not Logged in";
      }
      require_once('views/home/index.php');
    }

    public function error()
    {
      require_once('views/home/error.php');
    }
  }
