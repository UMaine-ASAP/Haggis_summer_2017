<?php
  class HomeController
  {
    public function index()
    {
      $userFunctions ="";
      if(isset($_SESSION['token']))
      {
        $user = true;
        if(CheckAdmin::check($_SESSION['token']))
          $userFunctions = UserFunctions::admin();
        else
          $userFunctions = UserFunctions::user();
        }
      else
        $userFunctions = UserFunctions::public();

      require_once('views/home/index.php');
    }

    public function error()
    {
      require_once('views/home/error.php');
    }
  }
