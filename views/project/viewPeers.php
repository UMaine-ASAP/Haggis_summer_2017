<?php


$projects = $a->projects;

$groups = array();
$targetGroup;
$counter = 1;
foreach($projects as $p)
{
  if($p->list > 0)
  {
    $targetGroup = $p->list;
    foreach($p->list as $l)
      if($l->id == $userID)
        {
          break(2);
        }
  }
  $counter++;
}

$gs = sizeof($targetGroup);


  echo "Members (".$gs.")<hr class='minor'>";
  echo "<div class='key'> <h5>Key:</h5>";
  echo "<i class='evalstatus glyphicon glyphicon-check' style='color:blue'></i> Critique completed<br>";
  echo "<i class='evalstatus glyphicon glyphicon-edit' style='color:red'></i> Needs critique";
  echo "</div>";
  // foreach($evaluated as $e)
  // {
  //   echo $e."<br>";
  // }

  foreach($targetGroup as $t)
  {
    if($t->id != $userID)
    {
      $done = (in_array($t->id, $evaluated) ? 'yes' : 'no');
      //$done = (in_array($p->id, $evaluated) ? 'yes' : 'no');
      echo "<div><button class='projectButton' onclick='GetAssignmentProject(";

      echo $t->id.',';
      echo ($a->type == 'submission' ? "1" : "3");

      echo ",".$a->id.")' class='standard projectitem' id='".$t->id."'><strong>".$t->firstName." ".$t->lastName."</strong><br> ";
      echo ($done == 'yes' ? "<i class='evalstatus glyphicon glyphicon-check' style='color:blue'></i>" : "<i class='evalstatus glyphicon glyphicon-edit' style='color:red'></i>");
      echo "</button>";
      echo "</div>";
    }
  }



 ?>
