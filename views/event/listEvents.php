<div class='container'>

  <h2>Live Events</h2>
  <hr>
  <div class='spacer2'></div>
  <!-- <div>
    <input class='joinedInputMedium' type='text' name='searchString' placeholder='search'><button class='joinedButtonMedium' type='submit'><i class="glyphicon glyphicon-search" size='smaller'></i></button>
  </div> -->
  <?php if($status==='admin')
  {
  ?>
  <a href='?controller=event&action=createEvent'>
    <div class ='classCard'>
    <table  id='createEvent' puW='300' puH='600' topoffset='-500'>
      <tr>
        <td class='cardtitle'>
            <i class="glyphicon glyphicon-plus"></i>
        </td>
      </tr>
      <tr>
        <td class='cardContents'>
        new event
        </td>
      </tr>
    </table>
    </div>
  </a>
    <?php
  }
  $inactiveEvent = array();
  if(sizeof($events) > 0)
  {
    foreach($events as $e)
    {
      if($e->active)
      {
        echo "<a href='?controller=pages&action=events&eventID=".$e->id."'><div class='classCard'>";
        echo "<table class='cardContents'>";
        echo "<tr><td class='coursename'>".$e->title."</td></tr>";
        echo "<tr><td>".$e->startDate." - ".$e->endDate."<br></td></tr>";
        echo "<tr><td>".$e->startTime." - ".$e->endTime."</td></tr>";
        echo "</table></div></a>";
      }
      else
      {
        $inactiveEvent[]=$e;
      }
    }
    if($status == 'admin')
    {
      echo "<hr> <h2>Inactive Events</h2>";
      foreach($inactiveEvent as $e2)
      {
        echo "<a href='?controller=pages&action=events&eventID=".$e2->id."'><div class='classCard'>";
        echo "<table class='cardContents'>";
        echo "<tr><td class='coursename'>".$e2->title."</td></tr>";
        echo "<tr><td>".$e2->startDate." - ".$e2->endDate."<br></td></tr>";
        echo "<tr><td>".$e2->startTime." - ".$e2->endTime."</td></tr>";
        echo "</table></div></a>";
      }
    }
  }
  else
  {
    echo "<p>No Events</p>";
  }
?>
</div>
