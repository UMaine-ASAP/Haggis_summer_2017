<?php

if(isset($_SESSION['current']))
{
  echo "<h2 class='currentTitle'>".$_SESSION['current']."</h2>";
}
