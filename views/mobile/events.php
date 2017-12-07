<h3 class="currentPage">
  <a class="backButton" href="index.php">&lt;- Back</a>
  Live Events
</h3>
  <!-- <div>
    <input class='joinedInputMedium' type='text' name='searchString' placeholder='search'><button class='joinedButtonMedium' type='submit'><i class="glyphicon glyphicon-search" size='smaller'></i></button>
  </div> -->
  <?php

  if(sizeof($events) > 0)
  {
    foreach($events as $e)
    {
      echo "<a href='?controller=mobile&action=projects&eventID=".$e->id."'><div class='classCard'>";
      echo "<table class='cardContents'>";
      echo "<tr><td class='coursename'>".$e->title."</td></tr>";
      echo "<tr><td>".$e->startDate." - ".$e->endDate."<br></td></tr>";
      echo "<tr><td>".$e->startTime." - ".$e->endTime."</td></tr>";
      echo "</table></div></a>";
    }
  }
  else
  {
    echo "<p>No Active Events</p>";
  }
?>
