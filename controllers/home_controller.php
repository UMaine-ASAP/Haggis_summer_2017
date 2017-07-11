<?php
  class HomeController
  {
    public function index()
    {
      
      require_once('views/home/index.php');
    }

    public function error()
    {
      require_once('views/home/error.php');
    }
  }
