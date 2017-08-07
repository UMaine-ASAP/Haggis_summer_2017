<h2>Classes</h2>

<?php
  foreach($classes as $class)
  {
    echo "<a href='#'>";
    echo "<div class='classes'>";
    echo $class->coursename." ".$class->title."<br>";
    echo "</div></a>";

  }
  ?>

<a href='?controller=class&action=joinClass'>
  <div>
    Join a Class
  </div>
</a>
