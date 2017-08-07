<h2>Join a Class</h2>
<div> <?php if(isset($message)) echo $message; ?></div>
<div>
  <form method='post' action='?controller=class&action=joinClass'>
    <select name='class'>
      <?php
      foreach($courses as $course)
      {
        foreach($course->classes as $class)
        echo "<option value='".$class->id."'>".$course->title." ".$class->title."</option>";
      }
      ?>
    </select><br>
    <input type='submit' value='Join Class'>
  </form>
</div>
