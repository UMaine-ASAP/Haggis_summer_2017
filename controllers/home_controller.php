<?php
  class HomeController
  {
    public function index()
    {
      if(isset($_SESSION['token']))
        $user = CheckAdmin::check($_SESSION['token']);
      require_once('views/home/index.php');
    }

    public function error()
    {
      require_once('views/home/error.php');
    }
  }
