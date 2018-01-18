
function addACritiera(counter,scale)
{
  var div = document.createElement('div');
  div.className='criteriaCard';
  div.id = counter;
  var htmlstuff ='';

  htmlstuff = "<input class='standard criteriaName' id='"+counter+"' name='criteriaName[]' placeholder='name of criteria' list='criterias' required oninput='updatelable(event)'>\
  <div  class='removeCriteria' id='"+counter+"'><i class='glyphicon glyphicon-remove'></i></div>\
  <br><div class='descriptholder' id='"+counter+"'>";
  for(var i = 0; i<scale;i++)
    htmlstuff += "<textarea class='standard criteriadescription' id='"+counter+"-"+i+"' name='criteriadescription[]' cols='40' rows='3' placeholder='description of this criteria (to guide your students)' required oninput='updateDescript(event)'></textarea>";
  htmlstuff += "<br>\
  allow additional text response\
  <input class='standard' type='radio' name='textresponse"+counter+"' value='yes' checked>yes\
  <input class='standard' type='radio' name='textresponse"+counter+"' value='no'>no";

  div.innerHTML = htmlstuff;
  document.getElementById('criteriacardcontainer').appendChild(div);

  var row = document.createElement('tr');
  row.className='criteriaholder';
  row.id = counter;
  var htmlstuff = "<td class='lable' id='"+counter+"'>Lable</td>";
  for(var i = 0; i < scale; i++)
  {
    htmlstuff += "<td class='rubricdescription' id='"+counter+"-"+i+"'>"+i+"</td>";
  }
  row.innerHTML = htmlstuff;
  document.getElementById('rubricview').appendChild(row);
}


function changetablesize(input)
{
  var number = input;
  var criteriaLable = "<td class='lable' id='##'>Lable</td>";
  var output = "";
  var newheader = "<th>Criteria</th>";

  var elements = document.getElementsByClassName('criteriaholder');

  for(var i = 0; i < input;i++)
  {
    newheader += "<th><input class='standard' type='number' name='criteriascore[]' maxlength='3' style='width:50px'></th>";
    output += "<td>"+i+"</td>";
  }
  document.getElementById('colheaders').innerHTML=newheader;
  for(var i = 0; i < elements.length;i++)
  {
    var newbit = criteriaLable.replace("##", i);
    elements[i].innerHTML = newbit+output;
  }

  var descriptoinholders = document.getElementsByClassName('descriptholder');
  for(var i = 0; i < descriptoinholders.length; i++)
  {
    var currID = descriptoinholders[i].id;
    var boxes ='';
    for(var j = 0; j<input;j++)
      boxes += "<textarea class='standard criteriadescription' id='"+currID+"-"+j+"' name='criteriadescription[]' cols='40' rows='3' placeholder='description of this criteria (to guide your students)' required oninput='updateDescript(event)'></textarea>";
    descriptoinholders[i].innerHTML = boxes;
  }


  // document.getElementsByClassName('criteriaholder').value = output;
}

function updatelable(event)
{
  var val = event.target.value;
  var ident = event.target.id;
  var elements = document.getElementsByClassName('lable');
  for(var i = 0; i < elements.length; i++)
  {
    if(elements[i].id == ident)
    {
      elements[i].innerHTML = val;
    }
  }
}

function updateDescript(event)
{
  var val = event.target.value;
  var ident = event.target.id;
  var elements = document.getElementsByClassName('rubricdescription');
  for(var i = 0; i < elements.length; i++)
  {
    if(elements[i].id == ident)
    {
      elements[i].innerHTML = val;
    }
  }
}

function removeACriteria(counter)
{
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
}

$(document).ready(function()
{
  var counter = 0;
  var scale = 1;
  $(document).on("click",".removeCriteria", function(e)
  {
    if(counter > 0);
      counter--;
    removeACriteria(counter);
  });


  $('#addCriteria').click(function(){
    counter++;
    addACritiera(counter, scale);
  });

  $('#scoringrange').change(function(event)
  {
    scale = event.target.value;
    changetablesize(scale);
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
