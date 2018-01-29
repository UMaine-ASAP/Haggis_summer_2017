var range = 1;
var count = 0;
$(document).ready(function()
{
  document.getElementById("criteraCopyManager").style.display = 'none';
  var temprange;
  $("#scoringrange").on('focusin', function(event)
  {
    temprange = event.target.value;
  });

  $("#scoringrange").on("change", function(event)
  {
    if(confirm("By Changing the range, you will loose any entered data. Do you wish to continue?"))
    {
      changeRange(event.target.value);
      range = event.target.value;
    }
    else
    {
      event.target.value=temprange;
    }
  });

  $(".addCriteria").on("click", function()
  {
    count++;
    addCriteria(count, range);
  });


});

function showTargetHideOther(event, targetID, otherID)
{
  document.getElementById(targetID).style.display = 'inline';
  document.getElementById(otherID).style.display = 'none';
  document.getElementById('copyRubric').value= event.target.value;
}

function changeRange(rangein)
{
  var colheaderstart = "<th>Criteria</th>";
  var colheaderleading="";
  for(var i = 0; i < rangein; i++)
  {
    colheaderleading += "<th class='scoreheader'><input class='standard' type='number' name='rangePoint[]' maxlength='3' style='width:50px'></th>";
  }
  document.getElementById('colheaders').innerHTML = colheaderstart + colheaderleading;
  document.getElementById('rubricbottomrow').setAttribute("colspan", rangein+1);
  var criteriadesccontainers = document.getElementsByClassName('criteriadesccontainer');
  var table = document.getElementById("rubricview");
  for(var i = 1; i< table.rows.length-1 ;i++ )
  {
    var curr = criteriadesccontainers[i-1];
    curr.innerHTML = "";
    var currrow = table.rows[i];
    var contents = currrow.innerHTML;
    var contentsID = currrow.id;
    currrow.innerHTML="";
    var leadingcell = currrow.insertCell(0);
    leadingcell.id = contentsID+"-0";
    leadingcell.innerHTML = contents;

    for(var j = 1; j < (parseInt(rangein)+1); j++ )
    {
        var idout = contentsID+"-"+(parseInt(j));
        var newcell = currrow.insertCell(j);
        newcell.id = idout;
        newcell.className='criDesc';
        newcell.setAttribute("style", "width="+(100/(parseInt(rangein)+1))+"%");
        var textarea = document.createElement("textarea");
        textarea.id = contentsID+"-"+j;
        textarea.required = true;
        textarea.className='standard';
        textarea.setAttribute("name", contentsID+"[]" )
        textarea.rows=6;
        textarea.cols=50;
        textarea.setAttribute("oninput", "updateContents(event)");
        curr.appendChild(textarea);
    }
  }
  updateAll();


}

function addCriteria(countin, rangein)
{

  var table = document.getElementById("rubricview");
  var row  = table.insertRow(table.rows.length-1);
  row.id = countin;
  var lablecell = row.insertCell(0);
  lablecell.innerHTML = "Criteria Name";
  lablecell.id = countin+"-0";
  for(var i = 1; i < (parseInt(rangein)+1); i++)
  {
    var newcell = row.insertCell(i);
    newcell.id= countin+"-"+i;
    newcell.className='criDesc';
    newcell.setAttribute("style", "width="+100/rangein+"%");
  }

  var criteriacontainer = document.getElementById('criteriacardcontainer');
  var criteriacard = document.createElement("div");
  criteriacard.id = countin;
  criteriacard.className='criteriaCard';
  criteriacard.innerHTML = "<div class='removeCriteria' id='"+countin+"' onclick='removeCriteria(this.id)'><i class='glyphicon glyphicon-remove' ></i></div><input class='standard criterianame' type='text' name='criterianame[]' id='"+countin+"-0' oninput='updateContents(event)' placeholder='Criteria Name' required>";
  criteriacontainer.appendChild(criteriacard);
  var criteriadesccontainer = document.createElement("div");
  criteriadesccontainer.id = countin;
  criteriadesccontainer.className= "criteriadesccontainer";
  criteriacard.appendChild(criteriadesccontainer);

  for(var i = 1; i < (parseInt(rangein)+1); i++)
  {
    var textarea = document.createElement("textarea");
    textarea.rows=6;
    textarea.cols=50;
    textarea.required = true;
    textarea.id = countin+"-"+i;
    textarea.className = 'standard';
    textarea.setAttribute("name", countin+"[]")
    textarea.setAttribute("oninput", "updateContents(event)");
    criteriadesccontainer.appendChild(textarea);
  }
}

function removeCriteria(idin)
{
  var tempcount = count;
  var targetID = idin;
  var cards = document.getElementsByClassName('criteriaCard');
  var table= document.getElementById('rubricview');
  recounter = count-1;
  for(var i = cards.length-1; i> -1; i--)
  {
    var currCard = cards[i];
    if(currCard.id == targetID)
    {
      currCard.parentNode.removeChild(currCard);
        tempcount--;
    }
    else
    {
      currOldID = currCard.id;
      currCard.id=recounter;
      currCard.getElementsByClassName('removeCriteria')[0].id=recounter;
      currCard.getElementsByClassName('criteriadesccontainer')[0].id=recounter;
      currCard.getElementsByClassName('criterianame')[0].id=recounter+"-0";
      var textareas = currCard.getElementsByTagName('textarea');
      for(var j = 1; j < textareas.length+1; j++)
      {
        textareas[j-1].id=recounter+"-"+j;
        textareas[j-1].setAttribute("name", recounter+"[]")
      }
      recounter--;
    }

  }
  recounter2 = count-1;
  for(var i=table.rows.length-2; i >0 ; i--)
  {
    var currRow = table.rows[i];
    if(currRow.id == targetID)
    {
      currRow.parentNode.deleteRow(i);
    }
    else
    {
      currRow.id=recounter2;
      var cells = currRow.cells;
      for(var j = 0; j < cells.length;j++)
      {
        var currCell = cells[j];
        currCell.id= recounter2+"-"+j;
      }
      recounter2--;
    }
    if(tempcount < count)
    {
      count--;
    }
  }

}

function updateAll()
{
  var criteriaNames = document.getElementsByClassName('criterianame');
  for(var i = 0; i < criteriaNames.length; i++)
  {
    var currID = criteriaNames[i].id;
    var content = criteriaNames[i].value;
    if(content == "")
      content = "Criteria Name";
    document.getElementById(currID).innerHTML = content;
  }

}

function updateContents(event)
{
  var targetID = event.target.id;
  var content = event.target.value;
  if(content != "")
    document.getElementById(targetID).innerHTML = content;
  else
    document.getElementById(targetID).innerHTML = "Criteria Name";
}
