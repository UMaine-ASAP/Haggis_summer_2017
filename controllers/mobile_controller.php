<?php

class MobileController
{
//=================================================================================== INDEX
    public function index()
    {
      require_once('views/mobile/index.php');
    }
//=================================================================================== LOGIN PAGE
    public function login()
    {
      require_once('views/mobile/login.php');
    }
//=================================================================================== REGISTRATION PAGE
    public function register()
    {
      require_once('views/mobile/register.php');
    }
//=================================================================================== CLASSES PAGE
    public function classes()
    {
      require_once('views/mobile/classes.php');
    }
}

?>
