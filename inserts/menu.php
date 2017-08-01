<?php
if(isset($_SESSION['token']))
  if(User::checkAdmin($_SESSION['token'])[1])
    $_SESSION['userFunctions'] = UserFunctionAccess::getFunctions("admin");
  else
    $_SESSION['userFunctions'] = UserFunctionAccess::getFunctions("user");
else
  $_SESSION['userFunctions'] = UserFunctionAccess::getFunctions("anon");


switch($_SESSION['userFunctions']->type)
{
  case "anon": ?>
    Login to see your options
    <?php break;
  default: ?>
    Navigation<br>
    <ul>
      <li><a href ="?controller=pages&action=classes">Your Classes</a></li>
      <li><a href ="?controller=pages&action=assignments">Your Assigments</a></li>
      <li><a href ="?controller=pages&action=groups">Your Groups </a></li>
    </ul>
    Administration<br>
    <?php
      echo "<ul>";
      foreach($_SESSION['userFunctions']->user as $option)
        echo "<li><a href='?controller=".$option['controller']."&action=".$option['action']."'>".$option['name']."</a></li>";
      echo "</ul><ul>";
      foreach($_SESSION['userFunctions']->group as $option)
        echo "<li><a href='?controller=".$option['controller']."&action=".$option['action']."'>".$option['name']."</a></li>";
      echo "</ul><ul>";
      foreach($_SESSION['userFunctions']->class as $option)
        echo "<li><a href='?controller=".$option['controller']."&action=".$option['action']."'>".$option['name']."</a></li>";
      echo "</ul>";
    ?>
    <?php break;
}
?>
