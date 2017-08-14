<?php

if(isset($_SESSION['current']))
{
  echo "<h2 class='currentTitle'>".$_SESSION['current']."</h2>";
}

if(isset($_SESSION['token']))
{
  echo $_SESSION['firstName']." ".$_SESSION['lastName'];
}
