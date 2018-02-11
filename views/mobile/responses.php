
  <a  href=<?php echo "index.php?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$assignmentID; ?>><button class="buttonLink"><i class="glyphicons glyphicons-arrow-left">Back</button></a>
    <br>
  <h3 class="currentPage">  Project Responses</h3>

    <div class='chart'></div>

    <?php
    $i=0;
    if(sizeof($cNames)<1)
      echo "No Evaluations yet, Be the first!";
    else
    {
      foreach($cNames as $n)
      {
        echo "<h3>".$n."</h3>";
        if($cAvg[$i] > 0)
          echo "Average Rating: ".$cAvg[$i]."<br>";
        foreach($cComments[$i] as $c)
        {
          if(sizeof($c) > 0)
          {
            for($j = 0; $j < sizeof($c); $j++)
            {
              echo "<span>".$c."</span><br>";
            }
          }
          else
            echo $c."<br>";
        }
        echo "<hr>";
        $i++;
      }
    }
    ?>
