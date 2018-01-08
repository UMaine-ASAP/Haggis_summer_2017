

<div class='container'>

  <h2>Your Classes</h2>
  <hr>
  To add classes, enter your class code below
  <div> <?php if(isset($message)) echo $message; ?></div><br>
  <div>
    <form method='post' action='?controller=class&action=joinClass'>
      <input class='joinedInputSmaller' type='text' name='joinCode' placeholder='Enter Class Code' required><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-plus" size='smaller'></i></button>
    </form>
  </div>
  <?php if($status==='admin')
  {
  ?>
    <div class ='classCard'>
    <table class='popupmaker' id='createClass' puW='300' puH='600' topoffset='-500'>
      <tr>
        <td class='cardtitle'>
            <i class="glyphicon glyphicon-plus"></i>
        </td>
      </tr>
      <tr>
        <td class='cardContents'>
        new class
        </td>
      </tr>
    </table>
    </div>
    <?php
  }

  ?>
<?php
foreach($classes as $class)
{

  echo "<a href='?controller=pages&action=classes&classcode=".$class->joinCode."'><div class='classCard'>";
  echo "<table class='cardContents'>";
  echo "<tr><td class='coursename'>".$class->coursecode."</td></tr>";
  echo "<tr><td>".$class->title."<br></td></tr>";
  echo "<tr><td>Location: ".$class->location."</td></tr>";
  echo "<tr><td>Meets at: ".$class->timeStart." to ".$class->timeEnd."</td></tr>";
  echo "<tr><td>On: ";
  $daySize = sizeof($class->days);
  if($daySize > 0 )
  {
    for($i = 0; $i<$daySize-1; $i++)
    {
      echo substr($class->days[$i],0,2);
      if($i == $daySize-2)
      {
        $i++;
        echo ", and ".substr($class->days[$i],0,2);
      }
      else
      {
        echo ", ";
      }
    }

  }
  echo "</table></div></a>";
}

?>



</div>
