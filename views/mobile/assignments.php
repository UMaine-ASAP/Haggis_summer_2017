
<div class='titlespan'>
<div class='bbcontainer'>
  <a href="index.php?controller=mobile&action=classes" class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Assignments</h3>
  </div>
</div>


<br>
<?php
foreach($assignments as $a)
{
  if($a->assigned)
  {
    echo "<div class='assignmentCard' id='$a->id'>";
    echo "<h3>".$a->title."</h3>";
    echo "<br><a href='?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$a->id."'><button class='buttonLink'>View Projects</button></a></div>";
  }
}
?>

<script src="js/toggleTab.js"></script>
