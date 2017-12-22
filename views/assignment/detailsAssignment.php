<h2> Assignment Details</h2>

<?php
////////////////////////////////////////////////////// CLASS DETAILS
echo "<div class='details' id='".$a->id."'>
Due Date:".$a->duedate."<br>
<h3>Prompt</h3>
".$a->description."<br>";

foreach($a->criterias as $c)
{

  echo "<div><h3>".$c->title."</h3> on scale of ".$c->ratingMin." to ".$c->ratingMax."</div>";
  foreach($c->criterias as $subc)
  {
    echo "<div>".$subc->description." - ".$subc->ratingValue."</div>";
  }
}
?>
