<div class='menutitle'>
Assignments(<?php echo sizeof($assignment);?>)
</div>
<br>
<div>
  New Assignment +
</div>
<br>
<div>
  <input class='joinedInputSmaller' type='text' name='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<?php
foreach($assignment as $a)
{
  echo $a->title."<br>";
}
?>
