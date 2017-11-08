<h2 class="currentPage">Add Classes</h2>
<div class='container'>
  <p class="reg">To add classes, enter your class code below</p>
  <div> <?php if(isset($message)) echo $message; ?></div><br>
  <div>
    <form method='post' action='?controller=mobile&action=joinClass'>
      <div class="inputClasses push inline"><input class='typeBoxSmall' type='text' name='joinCode' placeholder='Class Code'></div><div class="inline"><button class="smallButton" type='submit'><i size='smaller' class="glyphicon glyphicon-plus" size='smaller'></i></button></div>
    </form>
  </div>
<?php
foreach($classes as $class)
{

  echo "<a href='?controller=mobile&action=assignments&classID=".$class->id."'><div class='classCard'>";
  echo "<table class='cardContents'>";
  echo "<tr><td class='courseName'>".$class->coursecode."</td></tr>";
  echo "<tr><td class='cardContents'>".$class->title."<br></td></tr>";
  echo "<tr><td class='cardContents'>Location: ".$class->location."</td></tr>";
  echo "<tr><td class='cardContents'>Meets at: ".$class->timeStart." to ".$class->timeEnd."</td></tr>";
  echo "<tr><td class='cardContents'>On: ";
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
