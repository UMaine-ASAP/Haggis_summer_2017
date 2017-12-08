
function addACritiera(counter)
{
  var div = document.createElement('div');
  div.className='criteriaCard';
  div.id = counter;
  div.innerHTML = "<input class='standard' name='criteriaName[]' placeholder='name of criteria' list='criterias' required>\
  <div  class='removeCriteria' id='"+counter+"'><i class='glyphicon glyphicon-remove'></i></div>\
  graded on a scale from <input type='number' class='standard' name='from[]' placeholder='#' min='0' max='1000'> to\
  <input class='standard' type='number' name='to[]' placeholder='#'min='0' max='1000'>\
  <input class='standard' type='checkbox' id='noGrade'>n/a\
    <input type='hidden' name='graded[]' value='yes'>\
  <br>\
  <textarea class='standard criteriadescription' id='criteriadescription"+counter+"' name='criteriadescription[]' cols='40' rows='3' placeholder='description of this criteria (to guide your students)' required></textarea><br>\
  allow additional text response\
  <input class='standard' type='radio' name='textresponse"+counter+"' value='yes' checked>yes\
  <input class='standard' type='radio' name='textresponse"+counter+"' value='no'>no";

  document.getElementById('criteriacardcontainer').appendChild(div);
}

$(document).ready(function()
{
  var counter = 0;
  $(document).on("click",".removeCriteria", function(e)
  {
    if(counter > 0);
      counter--;
    var curr = $(this).attr('id');
    $('#'+curr+'.criteriaCard').remove();

    var cards = document.getElementsByClassName('criteriaCard');
    var textareas = document.getElementsByClassName('criteriadescription');
    var exitbox = document.getElementsByClassName('removeCriteria');
    for(var i = 0; i<cards.length;i++)
    {
      cards[i].id= i;
      cards[i].getElementsByClassName('criteriadescription')[0].id = 'criteriadescription'+i;
      cards[i].getElementsByClassName('removeCriteria')[0].id= i;
      var list = cards[i].querySelectorAll('input[type="radio"]');
      for(var j=0; j<list.length; j++)
        list[j].setAttribute('name', 'textresponse'+i);
    }
  });


  $('#addCriteria').click(function(){
    counter++;
    addACritiera(counter);
  });


  $('#save').click(function(){
    var setName = document.getElementById('setName').value;
    document.getElementById('setSaver').innerHTML="<input type='hidden' name='savedSetName' value='"+setName+"'> Set will be saved as: "+ setName;
    $(".overlay, #saveSetDiv").fadeToggle();
  })

  $(document).on("change", "#noGrade", function(event){
    var output;
    var trigger = $(this);
    if(event.target.checked)
    {
      output = "<input type='hidden' name='graded' value='no'>";
      trigger.prev().prop('disabled', true);
      trigger.prev().prev().prop('disabled', true);
      trigger.next().val("no");
    }
    else
    {
      output = "<input type='hidden' name='graded' value='yes'>";
      trigger.prev().prop('disabled', false);
      trigger.prev().prev().prop('disabled', false);
      trigger.next().val("yes");
    }
    //trigger.next().innerHTML= output;
  })

  $(document).on("input","input[name='criteriaName[]']", function(event){
    var searchfor = $(this).val();
    var id = $(this).parent().attr('id');
    if(searchfor != "")
      var description = $("#"+searchfor).attr('value');
    if(description == null)
      description = "";
    document.getElementById('criteriadescription'+id).value = description;
  })
});
