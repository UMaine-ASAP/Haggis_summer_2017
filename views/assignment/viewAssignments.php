<div class='menutitle'>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<div id='OUTPUT'>testblock</div>
<div>
  <?php if($status === 'admin') ?>
  <a class ='newAssignment' href='#'>New Assignment +</a>
</div>
<br>
<div>
  <input class='joinedInputSmaller' type='text' name='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<ul>
<?php
foreach($assignments as $a)
{
  echo "<li class='assignments' id='".$a->id."'>".$a->title."</li>";
}
echo "</ul>";
if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>

<div id='assignmentcreator' class='popup'><?php require_once('views/assignment/createAssignment.php');?></div>
