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
}

?>
