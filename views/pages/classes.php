<h2>Classes</h2>

<?php
if(isset($classes) && sizeof($classes) > 0)
{
  foreach($classes as $class)
  {
    echo "<a href='?controller=class&action=viewClass&classID=".$class->id."'><div class='classCard'>";
    echo "<table class='cardContents'>";
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
        echo substr($class->days[$i],0,2);
        if($i == $daySize-2)
        {
          echo ", and ".substr($class->days[$i+1],0,2);
          $i = $daySize;
        }
        else
          echo ", ";
      }
    }
    echo "</table></div></a>";
  }
  ?>

<a href='?controller=class&action=joinClass'><div class ='classCard'>
  <table>
    <tr>
      <td class='cardContents'>
        Join a Class
      </td>
    </tr>
    <tr>
      <td class='cardContents'>
        <i class="glyphicon glyphicon-plus"></i>
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
