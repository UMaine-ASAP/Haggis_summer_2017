<div class='titlespan'>
  <div class='bbcontainer'>
    <a  href=<?php echo "index.php?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$assignmentID; ?>><button class="buttonLink"><span class="glyphicons glyphicons-arrow-left"></span>Back</button></a>
    </div>
      <div class='currpagecontainer'>
    <h3 class="currentPage">  Project Responses</h3>
  </div>
</div>


    <div class='chart'></div>

    <?php
    $i=0;
    if(sizeof($cNames)<1)
      echo "No Evaluations yet, Be the first!";
    else
    {
      foreach($cNames as $n)
      {
        echo "<h3>".$n."</h3><br>";
        if($cAvg[$i] > 0)
          echo "<h4>Average Rating: ".$cAvg[$i]."</h4><br>";
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
