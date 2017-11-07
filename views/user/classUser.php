<script src="java/livesearch.js"></script>

<br>
<br>
<br>
<div>
    <input type='hidden' class='standard' value =<?php echo $NumofGroups;?> name='numofGroups'> <!--Helps form to work-->
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString2").value, "students", "orange")' type='text' id='searchString2' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<?php
foreach($students as $s)
{
  echo "<input type='checkbox' name='person' class='students' value='".$s->id."'>".$s->firstName." ".$s->lastName."<br>";
}

//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
