<script src="java/criteriaCreator.js"></script>
Criteria
<button id='savesetbut' class='popupmaker standard' type='button'>save this criteria set</button>
<button class='loadSet standard' type='button'>load saved set</button><div id='setSaver'></div>
<div id='criteriacardcontainer'>


  <div class='criteriaCard' id='0'>
    <input class='standard' type='text' name='criteriaName[]' placeholder='name of criteria' list='criterias' required>
    <div  class='removeCriteria' id='0'><i class='glyphicon glyphicon-remove'></i></div>
    graded on a scale from <input type='number' class='standard' name='from[]' placeholder='#' min='0' max='1000'> to
    <input class='standard' type='number' name='to[]' placeholder='#'min='0' max='1000'>
    <input class='standard' type='checkbox' id='noGrade'>n/a
    <input type='hidden' name='graded[]' value='yes'>
    <br>

    <textarea class='standard criteriadescription' id='criteriadescription0' name='criteriadescription[]' cols='40' rows='3' placeholder='description of this criteria (to guide your students)' required></textarea><br>
    allow additional text response
    <input class='standard' type='radio' name='textresponse[]' value='yes' checked>yes
    <input class='standard' type='radio' name='textresponse[]' value='no'>no
  </div>
</div>



<button type='button' class='standard' id='addCriteria'>add another criteria &emsp; &emsp; +</button>


<div id='savesetbut' class='popup'>
  <div  class='exit'><i class='glyphicon glyphicon-remove'></i></div>
  <h3>Save Set</h3><hr>
   <input type='text' placeholder='Name of Set' id='setName'><br>
   <textarea rows='4' cols='50' name='savedSetDescription'></textarea>
   <button type='button' id='save'>Save Set</button>
</div>
