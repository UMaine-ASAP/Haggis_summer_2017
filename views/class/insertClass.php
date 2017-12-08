<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="java/randomCode.js"></script>
<script src="java/classCreation.js"></script>
<div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
<h2>New Class</h2><hr>
  <form name='createaclass' action='?controller=class&action=insertClass' method='post' oninput='coursenameout.value=coursename.value+" "+coursecode.value'>
    <input type='hidden'  name='token'        value = '<?php echo $_SESSION['token'];?>'>

    <div id='part1'>
      <input class='standard'  type="radio" name ="newCourse" value='yes'>Create a new Course<br>
      <input class='standard'  type="radio" name="newCourse" value ='no'>Add to a pre-existing course<br>
      <div id='part1-1'>

        <input class='standard' type='text'    name='coursetitle'  id='coursename'      placeholder='Name of Course'    >     <br>
        <input class='standard' type='text'    name='coursecode'   id='coursecode'      placeholder='Set Course Code' pattern="[A-Za-z]{3}[0-9]{3}" title="Three letter and three number course code"  >    <br>
        <input class='standard' type='text'    name='coursedescription'  placeholder='Course Description' >
        <br><button class='standard' type='button' value='1-1' id='part1end'>Continue</button>

      </div>
      <div id='part1-2'>
        <select class='standard' name='courselisting'>
        <?php
        foreach($courselisting as $course)
        {
          echo "<option id =".$course->code." ".$course->title." value='".$course->id."'>".$course->code." ".$course->title."</option>";
        }
        ?>
        </select>
        <br><button class='standard' type='button' value='1-2' id='part1end'>Continue</button>
      </div>
      <div class='stepcounter'>Step 1 of 4</div>
    </div>

      <div id='part2'>
        <output id='coursenameout'></output>
        <input class='standard' type='text'    name='classtitle'        placeholder='Name of Class'><br>
        <input class='standard' type='text'    name='classdescription'  placeholder='Class Description'><br>
        <input class='standard' type='text'    name='location'     placeholder='Class Location'><br>
        <input class='standard' type='hidden'    name='classcode'    placeholder='Join Code' id='codebox'>
        <button class='standard' type='button' value='backto1' id='1'>Back</button>
        <button class='standard' type='button' value='2' id='2'>Continue</button>
        <div class='stepcounter'>Step 2 of 4</div>
      </div>

      <div id='part3'>
        Start/End times:<br>
        <input class='standard' type='time'    name='starttime'  placeholder='Start Time' required> -
        <input class='standard' type='time'    name='endtime'    placeholder='End Time' required>
        <hr class='minor'>
        Start/End dates:<br>
        <input class='standard' type='date'    name='startdate'  placeholder='Start Date' required> -
        <input  class='standard' type='date'    name='enddate'    placeholder='End Date' required>
        <hr class='minor'>
        Days:<br>
        Su<input class='standard' type='checkbox' name='sessiondays[]' value='sunday'>
        Mo<input class='standard' type='checkbox' name='sessiondays[]' value='monday'>
        Tu<input class='standard' type='checkbox' name='sessiondays[]' value='tuesday'>
        We<input class='standard' type='checkbox' name='sessiondays[]' value='wednesday'>
        Th<input class='standard' type='checkbox' name='sessiondays[]' value='thursday'>
        Fr<input class='standard' type='checkbox' name='sessiondays[]' value='friday'>
        Sa<input class='standard' type='checkbox' name='sessiondays[]' value='saturday'><br>
        <button class='standard' type='button' value='backto2' id='2'>Back</button>
        <button class='standard' value ='review' type='button'>Review</button>
        <div class='stepcounter'>Step 3 of 4</div>
      </div>
      <div id='review'>
        <div id='status'></div>
        <button class='standard' type='button' value='backto3' id='2'>Back</button>
       <input class='standard' type='submit' value='Create Class'>
       <div class='stepcounter'>Step 4 of 4</div>
      </div>
  <div class='error' id='courseError'></div>
  </form>
