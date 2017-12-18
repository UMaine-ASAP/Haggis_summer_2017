<?php
  header("Content-Type: application/vnd.ms-word");
  header("Content-Disposition: attachment;filename=".$project->title.".doc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns ="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Saves as a Word Doc</title>
</head>
<body>
  <h3>Project Responses</h3>
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
            echo $c."<br>";
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
</body>




</html>
