<?php

foreach($courses as $course)
{
  echo "<strong>".$course->title."</strong><br>";
  echo sizeof($course->classes);
  foreach($course->classes as $class)
  {
    echo "      ".$class->title."<br>";
  }
}

?>
