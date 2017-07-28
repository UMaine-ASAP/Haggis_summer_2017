<?php

class PagesController
{
    public function index()
    {
      require_once('views/pages/index.php');
    }

    public function classes()
    {
      require_once('views/pages/classes.php');
    }

    public function assignments()
    {
      require_once('views/pages/assignments.php');
    }

    public function groups()
    {
      require_once('views/pages/groups.php');
    }

    public function error()
    {
      require_once('views/pages/error.php');
    }
}

?>
