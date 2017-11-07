<h2 class="currentPage">Add Classes</h2>
<!--<div class='container'>
  To add classes, enter your class code below
  <div> <?php if(isset($message)) echo $message; ?></div><br>-->
  <div>
    <form method='post' action='?controller=mobile&action=joinClass'>
      <div class="inputClasses"><input class='typeBox' type='text' name='joinCode' placeholder='Class Code'></div><button type='submit'><i size='smaller' class="glyphicon glyphicon-plus" size='smaller'></i></button>
    </form>
  </div>
<?php
foreach($classes as $class)
{

  echo "<a href='?controller=pages&action=classes&classID=".$class->id."'><div class='classCard'>";
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
