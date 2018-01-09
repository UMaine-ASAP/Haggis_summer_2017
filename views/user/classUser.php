<script src="js/livesearch.js"></script>
<script src="js/checkboxManager.js"></script>

<div>
    <input type='hidden' class='standard' value =<?php echo $NumofGroups;?> name='numofGroups'> <!--Helps form to work-->
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString2").value, "students", "orange")' type='text' id='searchString2' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div><br>
<div>
  Selection Options:<br>
  <input class='standard' onclick="checkall('person');" type="button" value="All">
  <input class='standard' onclick="none('person');" type="button" value="None">
  <input class='standard' onclick="invert('person');" type="button" value="Invert">
</div>
<br>
<?php
foreach($students as $s)
{
  echo "<input type='checkbox' class='person standard' name='person[]' value='".$s->id."'><span class='students'>".$s->firstName." ".$s->lastName."</span><br>";
}

//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
