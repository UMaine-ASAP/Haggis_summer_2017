<?php

foreach($courses as $course)
{
  echo "<strong>".$course->title."</strong><br>";
  foreach($course->classes as $class)
  {
    echo "      ".$class->title."<br>";
  }
}

?>
