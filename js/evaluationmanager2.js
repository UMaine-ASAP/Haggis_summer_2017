$(document).ready(function()
{

  $('.slider').each(function()
  {
  initalizer($(this));

  });

  $('#evalout').hide();

  // $('.picker').on('click', function(e)
  // {
  //   if(e.target.id == "picker")
  //   {
  //     var thisElem = e.target;
  //     var criID = thisElem.getAttribute("scoreTarget");
  //     var criScore = thisElem.getAttribute("scoreVal");
  //     var criteriaOutputs = document.getElementsByClassName('criteriaRating');
  //
  //     for(var i = 0; i < criteriaOutputs.length; i++)
  //     {
  //       var currCri = criteriaOutputs[i];
  //       if(currCri.id == criID)
  //       {
  //         currCri.setAttribute('value', criScore);
  //       }
  //     }
  //      var others = document.getElementsByClassName("s"+criID);
  //
  //
  //     for(var i = 0; i < others.length;i++)
  //     {
  //       others[i].style.border="1px solid black";
  //       others[i].style.backgroundColor = "white";
  //     }
  //     event.target.style.border="2px solid red";
  //     event.target.style.backgroundColor="yellow";
  //   }
  // });

  $('.slider').on('input', function(e)
  {
    var thiselement = e.target;
    var criID = thiselement.getAttribute("id");
    var criScore = thiselement.value;
    var criteriaOutputs = document.getElementsByClassName('s'+criID);
    for(var i = 0; i < criteriaOutputs.length; i++)
    {
      var currCri = criteriaOutputs[i];

      if(currCri.getAttribute("scoreVal") == criScore)
      {
        currCri.setAttribute('style', "display:block");
      }
      else
      {
        currCri.setAttribute('style', "display:none");
      }
    }
  });

  $('.evalsubmit').on('click',function(e)
  {
    e.preventDefault();

    var session = false;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
           // Typical action to be performed when the document is ready:
          if(xmlhttp.responseText.trim() == "expired")
            loginer();
          else
          {
              submit();
          }
        }
    }
    xmlhttp.open("POST", "?controller=user&action=checkIfSessionActive&quick=1", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();


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


function initalizer(elementin)
{
  var thiselement = elementin;
  var criID = thiselement.attr("id");

  var criScore = thiselement.val();
  var criteriaOutputs = document.getElementsByClassName('s'+criID);
  for(var i = 0; i < criteriaOutputs.length; i++)
  {
    var currCri = criteriaOutputs[i];

    if(currCri.getAttribute("scoreVal") == criScore)
    {
      currCri.setAttribute('style', "display:block");
    }
    else
    {
      currCri.setAttribute('style', "display:none");
    }
  }
}

function loginer()
{
  var thisxmlhttp = new XMLHttpRequest();
  var email = prompt("Your session has expired. \n To login and submit your critique, enter your email: ", "Email address");
  var password = prompt("Enter your password","password");
  var message;
  var formdata = new FormData();
  formdata.append('email', email);
  formdata.append('current-password', password);
  thisxmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)
      {
        alert(thisxmlhttp.responseText.trim());
         // Typical action to be performed when the document is ready:
         if(thisxmlhttp.responseText.trim() == "You have successfully logged back in.")
         {
          submit();
        }
      }
  }
  thisxmlhttp.open("POST", "?controller=user&action=loginForJavascript&quick=1", true);
  thisxmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  thisxmlhttp.send("email="+email+"&current-password="+password);
}

function submit()
{
  var isMobile = $('#evalform').attr('isMobile');
  var commentboxes = document.getElementsByClassName('criteriaComment');
  var criteriaRatings = document.getElementsByClassName('criteriaRating');
  var criteriaMsgs = document.getElementsByClassName('criteriaMsg');
  var masterError = document.getElementById('masterError');

  var progress = true;
  for(var i = 0; i < commentboxes.length; i++)
  {
    var thisbox = commentboxes[i];
    criteriaMsgs[i].innerHTML = "";
    if(thisbox.value == "")
    {
      criteriaMsgs[i].style.border='2px dashed red';
      criteriaMsgs[i].innerHTML +=  'Missing Comment';
      masterError.style.border='2px dashed red';
      masterError.innerHTML = "There are one or more errors. Please review all entries";
      progress = false;
    }
    else
    {
      criteriaMsgs[i].style.border='0px dashed red';
      thisbox.style.border='1px solid black';
      masterError.style.border='0px solid black';
      masterError.innerHTML = "";
    }
  }
  if(progress)
  {
    var formsr = $('#evalform').serialize();

    // console.log(formsr);
    var projectID = $('input[name="evalfor"]').val();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
           document.getElementById('evalout').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "?controller=evaluate&action=submit&quick=1", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(formsr);

    if(isMobile =='false')
    {
      $('#evalout').show();
      $('#evalform').hide();
      var projectID = document.getElementsByClassName('evalfor')[0].value;
      $('#ProjectList').load('?controller=project&action=refreshList&quick=1&projectID='+projectID);
    }
    else
    {
      alert("Evaluation Submitted");
      window.location.href = document.getElementsByClassName('backButton')[0].getAttribute('href');
    }
  }
}





// function submitEval(e)
// {
//   e.preventDefault();
//
//   var commentboxes = document.getElementsByClassName('criteriaComment');
//   var progress = true;
//   for(var i = 0; i < commentboxes.length; i++)
//   {
//     var thisbox = commentboxes[i];
//     if(thisbox.value == "")
//     {
//       thisbox.style.border='2px dashed red';
//       thisbox.setAttribute('placeholder', "This Element is Required");
//       progress = false;
//     }
//   }
//   if(progress)
//   {
//     var formsr = $('#evalform').serialize();
//     //console.log(formsr);
//     var projectID = $('input[name="evalfor"]').val();
//     var xmlhttp = new XMLHttpRequest();
//     // xmlhttp.onreadystatechange = function()
//     // {
//     //   if(this.readyState==4 && this.status==200)
//     //   {
//     //     document.getElementById("evalout").append(this.responseText)
//     //   }
//     // };
//     xmlhttp.open("POST", "?controller=evaluate&action=submit&quick=1", true);
//     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xmlhttp.send(formsr);
//     $('#evalout').show();
//     $('#evalform').hide();
//   }
// }

// function makeselection(thiselement)
// {
//
// }
