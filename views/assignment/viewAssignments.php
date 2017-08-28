<div class='menutitle'>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<div>
  <?php if($status === 'admin') ?>
  <a class ='newAssignment' href='?controller=assignment'>New Assignment +</a>
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
  echo "<li id='".$a->id."'>".$a->title."</li>";
}
echo "</ul>";
if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
<p id='newAssignment'>New Assignment</p>

<div id='createassignment' class='popup'><?php require_once('views/assignment/createAssignment.php');?></div>
