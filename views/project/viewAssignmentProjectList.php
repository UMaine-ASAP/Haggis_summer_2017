<?php
$projects = $a->projects;
$ps = sizeof($projects);
$groups;

if($projects != null && $ps > 0)
{
  $sample = $projects[0];
  $test = $sample->isgroup;
  echo "projects (".$ps.")<hr class='minor'>";
  echo "<div class='key'> <h5>Key:</h5>";
  echo "<i class='evalstatus glyphicon glyphicon-check' style='color:blue'></i> Critique completed<br>";
  echo "<i class='evalstatus glyphicon glyphicon-edit' style='color:red'></i> Needs critique";
  echo "</div>";
  foreach($projects as $p)
  {
    $done = (in_array($p->id, $evaluated) ? 'yes' : 'no');
    echo "<div><button class='projectButton' onclick='GetAssignmentProject(";

    echo $p->id.',"'.$type.'"';

    echo ")' class='standard projectitem' id='".$p->id."'><strong>".$p->title."</strong><br> ";


    if($p->isgroup ==='1' || $p->isgroup ==='2')
    {
      $listing = $p->list;
      foreach($listing as $u)
      {
        echo $u->firstName." ".$u->middleInitial." ".$u->lastName."<br>";
      }
    }
    echo ($done == 'yes' ? "<i class='evalstatus glyphicon glyphicon-check' style='color:blue'></i>" : "<i class='evalstatus glyphicon glyphicon-edit' style='color:red'></i>");

    echo "</button>";



    echo "</div>";
  }

}

  ?>
