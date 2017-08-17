

<div class='container'>

  <h2>Your Classes</h2>
  <hr>
  <?php if(isset($_SESSION['token']) && User::checkAdmin($_SESSION['token']))
  {
  ?>
    <div class ='classCard'>
    <table class='createClass' puW='300' puH='600' topoffset='-500'>
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
  else
  {
    require_once('views/class/joinClass.php');
  }
  ?>
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



</div>
<div id='joinclass' class='popup'><?php require_once('views/class/joinClass.php');?></div>
<div id='createclass' class='popup'><?php require_once('views/class/insertClass.php');?></div>
