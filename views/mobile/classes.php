<h2 class="currentPage">Add Classes</h2>
<!--<div class='container'>
  To add classes, enter your class code below
  <div> <?php if(isset($message)) echo $message; ?></div><br>-->
  <div>
    <form method='post' action='?controller=mobile&action=joinClass'>
      <div class="inputClasses push inline"><input class='typeBoxSmall' type='text' name='joinCode' placeholder='Class Code'></div><div class="inline"><button class="smallButton" type='submit'><i size='smaller' class="glyphicon glyphicon-plus" size='smaller'></i></button></div>
    </form>
  </div>
<?php
foreach($classes as $class)
{

  echo "<a href='?controller=mobile&action=assignments&classID=".$class->id."'><div class='classCard'>";
  echo "<table class='cardContents'>";
  echo "<tr><td class='coursename'>".$class->coursecode."</td></tr>";
  echo "<tr><td>".$class->title."<br></td></tr>";
  echo "</table></div></a>";
}

?>
