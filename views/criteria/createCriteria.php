<script src="js/criteriaCreationManager.js"></script>
<?php if(isset($NumofGroups)){?>
<div class='sidebyside'>
<div><h2>Create rubric for: <h2></div>
<div><h2 class="assignmentName"></h2></div>
</div>
<?php } ?>
<strong>Scoring Range:</strong>
<input class='standard' name='scoringRange[]' type='number' id='scoringrange' value='1'>
<h3>Rubric View</h3>
<div id='rubriccontainer' class='rubriccontainer'>
  <table id='rubricview'>
    <tr id='colheaders'>
      <th>Criteria</th>
      <th class='scoreheader'><input class='standard' type='number' name='criteriascore[]' maxlength='3' style='width:50px'></th>
    </tr>
    <tr id='bottomRow'>
      <td id='rubricbottomrow'colspan='2' class='addCriteria'>
        <i class="glyphicon glyphicon-plus" size='medium'></i>
      </td>
    </tr>
  </table>
</div>



<div class='criteriacardcontainer'>
  <div id='criteriacardcontainer'></div>
  <button type='button' class='standard addCriteria mediumbutton' style="width:300px;text-align:center" >add another criteria &emsp; &emsp; +</button>
</div>






<!-- <button id='savesetbut' class='popupmaker standard' type='button'>save this criteria set</button>
<button class='loadSet standard' type='button'>load saved set</button><div id='setSaver'></div> -->
<!-- <div id='savesetbut' class='popup'>
  <div  class='exit'><i class='glyphicon glyphicon-remove'></i></div>
  <h3>Save Set</h3><hr>
   <input type='text' placeholder='Name of Set' id='setName'><br>
   <textarea rows='4' cols='50' name='savedSetDescription'></textarea>
   <button type='button' id='save'>Save Set</button>
</div> -->
