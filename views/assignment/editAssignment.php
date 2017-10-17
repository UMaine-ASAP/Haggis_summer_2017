

<input type='hidden' name='assignmentID' value ='<?php echo $assignment->id ?>'>
Title<br>
<input class='standard' type='text' name='title' value='<?php echo $assignment->title; ?>'><br>
Description<br>
<textarea rows='10' cols='100' class='standard' name='description'>
  <?php echo $assignment->description; ?>
</textarea><br>
Due Time<br>
<input class='standard' type='time' name='duetime' value='<?php echo $assignment->duetime; ?>'><br>
Due Date<br>
<input class='standard' type='date' name='duedate' value='<?php echo $assignment->duedate; ?>'><br>
Criterias<br>
<div><hr>
  <?php
    foreach($assignment->criterias as $c)
    {
      ?>
      <div>
      <input type='hidden' name='criteriaid' value='<?php echo $c->id ?>'>
      Name<br>
      <input class = 'standard' type='text' name='criterianame' value='<?php echo $c->title; ?>'><br>
      Description<br>
      <textarea class='standard' name='criteriadescription'>
        <?php echo $c->description ?>
      </textarea><br>
      Minimum Value<br>
      <input type='number' class='standard' name='criteriamin' value ='<?php echo $c->minRange;?>'><br>
      Maximum Value<br>
      <input type='number' class='standard' name='criteriamax' value ='<?php echo $c->maxRange;?>'><br>
      Text Responses Allowed<br>
      <?php if($c->allowTextResponse == '1'){ ?>

        yes<input type='radio' name="allowtextresponse" value = 1 checked>
        no<input type='radio' name="allowtextresponse" value = 0>
      <?php } else { ?>
        yes<input type='radio' name="allowtextresponse" value = 1>
        no<input type='radio' name="allowtextresponse" value = 0 checked>
      <?php } ?>
      </div>
      <hr>
      <?php
    }
  ?>
</div>
