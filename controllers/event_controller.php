
<?php

class EventController
{
//=================================================================================== INDEX
  public function add()
  {
    echo "Stuff is happening here";
  }

//=================================================================================== ERROR
  public function error()
  {
    require_once('views/home/error.php');
  }
}
?>
