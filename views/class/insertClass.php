<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="java/randomCode.js"></script>
<h2>Create a New Class</h2>
<div><?php echo $message; ?></div>

<div>
  <form action='?controller=class&action=insertClass' method='post'>
    <input type='hidden'  name='token'        value = '<?php echo $_SESSION['token'];?>'>
    <table>
      <tr>
        <td style="width:100px">
          <input type="radio" name ="newCourse" value="yes" required>Create a new Course<br>
          <input type='text'    name='coursetitle'        placeholder='Name of Course'    >     <br>
          <input type='text'    name='coursecode'         placeholder='Course Code (ex: NMD100)'   >    <br>
          <input type='text'    name='coursedescription'  placeholder='Course Description' >
        </td>
        <th style="width:10px">OR</th>
        <td>
          <input type="radio" name="newCourse" value ='no' required>Add to a pre-existing course<br>
          <select name='courselisting'>
            <?php
            foreach($courselisting as $course)
            {
              echo "<option value='".$course->id."'>".$course->title."</option>";
            }
            ?>
          </select>
        </td>
      </tr>
    </table>

    </div>
    <hr>
    <div>
      <input type='text'    name='classtitle'        placeholder='Name of Class' required>    <br>
      Start Time<input type='time'    name='starttime'  placeholder='Start Time' required><br>
      End Time:<input type='time'    name='endtime'    placeholder='End Time' required><br>
      Start Date<input type='date'    name='startdate'  placeholder='Start Date' required><br>
      End Date:<input type='date'    name='enddate'    placeholder='End Date' required><br>
      <table class='dayofweek'>
        <tr>
          <td>Sunday</td>
          <td>Monday</td>
          <td>Tuesday</td>
          <td>Wednesday</td>
          <td>Thursday</td>
          <td>Friday</td>
          <td>Sunday</td>
        </tr>
        <tr>
          <td><input type='checkbox' name='sessiondays[]' value='sunday'</td>
          <td><input type='checkbox' name='sessiondays[]' value='monday'></td>
          <td><input type='checkbox' name='sessiondays[]' value='tuesday'></td>
          <td><input type='checkbox' name='sessiondays[]' value='wednesday'></td>
          <td><input type='checkbox' name='sessiondays[]' value='thursday'></td>
          <td><input type='checkbox' name='sessiondays[]' value='friday'></td>
          <td><input type='checkbox' name='sessiondays[]' value='saturday'></td>
        </tr>
      </table>
      <input type='text'    name='classdescription'  placeholder='Class Description' required><br>
      <input type='text'    name='location'     placeholder='Class Location' required>   <br>
      <input type='text'    name='classcode'    placeholder='Join Code' id='codebox' required>
      <input type='button'  id='makerandom' value="Generate Random">
  </div>
    <input type='submit' value='Add Class'>
  </form>
</div>
