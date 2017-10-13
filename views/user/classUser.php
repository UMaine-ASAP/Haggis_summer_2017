<script src="java/livesearch.js"></script>

<br>
<br>
<br>
<div>
    <input type='hidden' class='standard' value =<?php echo $NumofGroups;?> name='numofGroups'> <!--Helps form to work-->
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString2").value, "students", "orange")' type='text' id='searchString2' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<ul id="studentList">
<?php
foreach($students as $s)
{
  echo "<li class='students' id='".$s->id."'>".$s->firstName." ".$s->lastName."</li>";
}
echo "</ul>";
//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
