//This search function is designed to take input and format a list of objects.
//  the first argument is the substring that we are searching for
//  the second argument is the class name of the list of elements we are searching through

//This version highlights elements that are found.
//    The third argument is the string color name of the highlighting (for customization)
function searchNhighlight(searchvalue, search, color)
{
  var sub =  searchvalue.toLowerCase();
  var elements = document.getElementsByClassName(search);
  if(sub != '')                               //if the text box is not empty
    for(var i = 0; i < elements.length; i++)
    {
      var searchin = elements[i].innerText;
      var index = searchin.toLowerCase().indexOf(sub);
      if( index !=-1)
        elements[i].style.backgroundColor= color;
      else
        elements[i].style.backgroundColor='';
    }
  else                                      //if the value of text box is empty
    for(var i = 0; i < elements.length; i++)
    {
      elements[i].style.backgroundColor='';
    }
}

// This version hides elements that do not contain the substring we are searching for.
function searchNhide(searchvalue, search)
{
  var sub =  searchvalue.toLowerCase();
  var elements = document.getElementsByClassName(search);
  if(sub != '')                               //if the text box is not empty
    for(var i = 0; i < elements.length; i++)
    {
      var searchin = elements[i].innerText;
      var index = searchin.toLowerCase().indexOf(sub);
      if( index !=-1)
        elements[i].style.display= "block";
      else
        elements[i].style.display="none";
    }
  else                                      //if the value of text box is empty
    for(var i = 0; i < elements.length; i++)
    {
      elements[i].style.display= "block";
    }
}
