<div class='menutitle'>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<div>
  <a class ='newAssignment' href='#'>New Assignment +</a>
</div>
<br>
<div>
  <input class='joinedInputSmaller' type='text' name='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<?php
foreach($assignments as $a)
{
  echo $a->title."<br>";
}
?>
<div id='createassignment' class='popup'><?php require_once('views/assignment/createAssignment.php');?></div>
