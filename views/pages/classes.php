<h1>Classes</h1>

<?php
  foreach($classes as $class)
  {
    echo "<a href='#'>";
    echo "<div class='classes'>";
    echo $class->title;
    echo "</div></a>";

  }
  ?>

<a href='?controller=class&action=joinClass'>
  <div>
    Join a Class
  </div>
</a>
