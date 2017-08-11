<h2>Classes</h2>

<?php
if(isset($classes))
{
  foreach($classes as $class)
  {
    echo "<a href='?controller=class&action=viewClass&classID=".$class->id."'><div class='classes'>";
    echo "<table class='listing'>";
    echo "<tr><td class='coursename'>".$class->coursecode."</td></tr>";
    echo "<tr><td>".$class->title."<br></td></tr>";
    echo "<tr><td>Location: ".$class->location."</td></tr>";
    echo "<tr><td>Meets at: ".$class->timeStart." to ".$class->timeEnd."</td></tr>";
    echo "<tr><td>On: ";
    $daySize = sizeof($class->days);
    if($daySize > 0 )
    {
      for($i = 0; $i<$daySize; $i++)
      {
        echo $class->days[$i];
        if($i == $daySize-2)
        {
          echo " and ".$class->days[$i+1];
          $i = $daySize;
        }
        else
          echo ", ";
      }
    }
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
<?php
}
else
{
  echo "Login to see your classes";
}
?>
