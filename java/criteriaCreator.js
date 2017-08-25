
function addACritiera(counter)
{
  var div = document.createElement('div');
  div.className='criteriaCard';
  div.id = counter;
  div.innerHTML = "<input class='standard' name='criteriaName[]' placeholder='name of criteria' list='criterias' required>\
  <div  class='removeCriteria'><i class='glyphicon glyphicon-remove'></i></div>\
  graded on a scale from <input type='number' class='standard' name='from' placeholder='#' min='0' max='1000'> to\
  <input class='standard' type='number' name='to' placeholder='#'min='0' max='1000'>\
  <div>\
    <input class='standard' type='checkbox' id='noGrade'>n/a\
    <div><input type='hidden' name='graded[]' value='yes'></div>\
  </div><br>\
  <textarea class='standard' id='text"+counter+"' name='criteriadescription[]' cols='40' rows='3' placeholder='description of this criteria (to guide your students)' required></textarea><br>\
  allow additional text response\
  <input class='standard' type='radio' name='textresponse[]' value='yes'>yes\
  <input class='standard' type='radio' name='textresponse[]' value='no'>no"

  document.getElementById('criteriacardcontainer').appendChild(div);
}


function removeACriteria(event)
{
  var card = document.getElementById(event.target.parentNode.parentNode.id);
  card.parentNode.removeChild(card);
  var cards = document.getElementsByClassName('criteriaCard');
  for(var i = 0; i<cards.length;i++)
  {
    cards[i].id= i;
    cards[i].getElementsByTagName('textarea').id = "text"+i;
  }
}





$(document).ready(function()
{
  var counter = 0;
  $(document).on("click",".removeCriteria", function(event){
    counter--;
    removeACriteria(event);
  })
  $('#addCriteria').click(function(){
    counter++;
    addACritiera(counter);
  })
  $('#save').click(function(){
    var setName = document.getElementById('setName').value;
    document.getElementById('setSaver').innerHTML="<input type='hidden' name='savedSetName' value='"+setName+"'> Set will be saved as: "+ setName;
    $(".overlay, #saveSetDiv").fadeToggle();
  })

  $("#noGrade").on("change", function(event){
    var output;
    var father = $(this).parent();
    var grandfather = father.parent();
    var greatgrandfather = grandfather.parent();
    if(event.target.checked)
    {
      output = "<input type='hidden' name='graded' value='no'>";
      greatgrandfather.find('input[type="number"]').prop('disabled', true);
    }
    else
    {
      output = "<input type='hidden' name='graded' value='yes'>";
      greatgrandfather.find('input[type="number"]').prop('disabled', false);
    }
    event.target.nextSibling.nextSibling.innerHTML = output;
  })

  $(document).on("input","input[name='criteriaName[]']", function(event){
    var searchfor = $(this).val();
    var id = $(this).parent().attr('id');
    if(searchfor != "")
      var description = $("#"+searchfor).attr('value');
    if(description == null)
      description = "";
    document.getElementById('text'+id).value = description;
  })


});
