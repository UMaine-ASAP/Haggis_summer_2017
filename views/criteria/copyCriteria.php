<script src="js/criteriaCopyManager.js"></script>
<div class='sidebyside'>
<div><h2>Copy rubric for: <h2></div>
<div><h2 class="assignmentName"></h2></div>
</div>
<div>
  <select class ='standard' name='rubricSelector' oninput="loadRubric(event)">
  <?php
  foreach($rubrics as $r)
  {
    echo "<option value='".$r->id."'>".$r->title."</option>";
  }
   ?>
 </select>
</div>
<div id='criteriaDump'>

</div>
