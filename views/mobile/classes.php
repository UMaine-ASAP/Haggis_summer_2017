<div class='titlespan'>
<div class='bbcontainer'>
  <a href="index.php"><button class='buttonLink'><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
</div>


    <div class='currpagecontainer'>
      <h3 class="currentPage">Classes</h3>
    </div>
  </div>


<div class='container'>
  <p class="reg">To add classes, enter your class code below</p>
  <div> <?php if(isset($message)) echo $message; ?></div><br>
  <div>
    <form method='post' action='?controller=mobile&action=joinClass'>
      <div class="inline">
      <div class="inputClasses push inline"><input class='typeBoxSmall' type='text' name='joinCode' placeholder='Class Code'></div><div class="inline"><button class='plus' type='submit'>+</button></div>
      </div>
    </form>
    <h4>Your Classes:</h4>
  </div>

<?php
foreach($classes as $class)
{

  echo "<a href='?controller=mobile&action=assignments&classID=".$class->id."'><div class='classCard'>";

  echo "<h3>".$class->coursecode."</h3><hr>";
  echo "<h4>".$class->title."</h4><br>";
  echo "Location: ".$class->location."<br>";
  echo "Meets at: ".$class->timeStart." to ".$class->timeEnd."<br>";
  echo "On: ";
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
  echo "</div></a>";
}
?>
</div>
