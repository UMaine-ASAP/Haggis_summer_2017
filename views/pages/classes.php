<h2>Classes</h2>

<?php
  foreach($classes as $class)
  {
    echo "<a href='#'><div class='classes'>";
    echo "<table class='listing'>";
    echo "<tr><td class='coursename'>".$class->coursename."</td></tr>";
    echo "<tr><td>".$class->title."<br>".$class->location."<br>".$class->sessionTime."</td></tr>";
    echo "</table></div></a>";
  }
  ?>

<a href='?controller=class&action=joinClass'><div class ='classes'>
  <table class='listing'>
    <tr>
      <td>
        Join a Class
      </td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
  </table>
  </div>
</a>
