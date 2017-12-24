$(document).ready(function()
{
  $('#evalout').hide();

  $('.picker').on('click', function(event)
  {
    if(event.target.id == "picker")
    {
      var thisElem = event.target;
      var criID = thisElem.getAttribute("scoreTarget");
      var criScore = thisElem.getAttribute("scoreVal");
      var criteriaOutputs = document.getElementsByClassName('criteriaRating');
      for(var i = 0; i < criteriaOutputs.length; i++)
      {
        var currCri = criteriaOutputs[i];
        if(currCri.id == criID)
        {
          currCri.setAttribute('value', criScore);
        }
      }
       var others = document.getElementsByClassName("s"+criID);


      for(var i = 0; i < others.length;i++)
      {
        others[i].style.border="1px solid black";
        others[i].style.backgroundColor = "white";
      }
      event.target.style.border="2px solid red";
      event.target.style.backgroundColor="yellow";
    }
  });

  $('.chooser').on('click',function(e)
  {
    e.preventDefault();
    var formsr = $('#evalform').serialize();
    console.log(formsr);
    var projectID = $('input[name="evalfor"]').val();
    var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function()
    // {
    //   if(this.readyState==4 && this.status==200)
    //   {
    //     document.getElementById("evalout").append(this.responseText)
    //   }
    // };
    xmlhttp.open("POST", "?controller=evaluate&action=submit&quick=1", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(formsr);
    $('#evalout').show();
    $('#evalform').hide();
  });
});


function getAllSiblings(elem, filter) {
    var sibs = [];
    elem = elem.parentNode.firstChild;
    do {
        if (elem.nodeType === 3) continue; // text node
        if (!filter || filter(elem)) sibs.push(elem);
    } while (elem = elem.nextSibling)
    return sibs;
}
