<?php

class TestingController
{
//=================================================================================== INDEX
    public function test()
    {

      $user = User::id(1)[1];
      echo $user->firstName; 
    }
}
?>
