<div class='container'>
  To add classes, enter your class code below<br>
  <div> <?php if(isset($message)) echo $message; ?></div><br>
  <div>
    <form method='post' action='?controller=mobile&action=joinClass'>
      <input class='joinedInputSmaller' type='text' name='joinCode' placeholder='Enter Class Code'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-plus" size='smaller'></i></button>
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
