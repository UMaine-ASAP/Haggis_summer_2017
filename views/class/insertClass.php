<h2>Create a New Class</h2>
<div><?php echo $message; ?></div>

<div>
  <form action='?controller=class&action=insertClass' method='post'>
    <input type='hidden'  name='token'        value = '<?php echo $_SESSION['token'];?>'>
    <div>
      <input type="radio" name ="newCourse" value="yes" required>Create a new Course<br>
      <input type='text'    name='coursetitle'        placeholder='Name of Course'    required>     <br>
      <input type='text'    name='coursecode'         placeholder='Code for course'   required>    <br>
      <input type='text'    name='coursedescription'  placeholder='Course Description' required> <br>

      <br><br>OR <br><br>
      <input type="radio" name="newCourse" value ='no' required>Add to a pre-existing course<br>
      <select name='courselisting'>
        <?php
          foreach($courselisting as $course)
          {
            echo "<option value='".$course->id."'>".$course->title."</option>";
          }

        ?>
      </select>

    </div>
    <br><br>
    <div>
      <input type='text'    name='classtitle'        placeholder='Name of Class' required>    <br>
      <input type='time'    name='sessiontime'  placeholder='Meeting Time' required>     <br>
      <input type='text'    name='classdescription'  placeholder='Class Description' required><br>
      <input type='text'    name='location'     placeholder='Class Location' required>   <br>
  </div>
    <input type='submit' value='Add Class'>
  </form>
</div>
