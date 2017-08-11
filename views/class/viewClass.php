<h2><?php echo $class->coursename." - ".$class->title;?></h2>

<?php
  echo $class->id."<br>";
  echo $class->title."<br>";
  echo $class->courseid."<br>";
  echo $class->coursecode."<br>";
  echo $class->coursename."<br>";
  echo $class->timeStart."<br>";
  echo $class->timeEnd."<br>";
  echo $class->dateStart."<br>";
  echo $class->dateEnd."<br>";
  echo $class->description."<br>";
  echo $class->location."<br>";
  echo $class->joinCode."<br>";
  foreach($class->days as $d)
  {
    echo $d;
  }
  ?>
