//use:   <script src="java/draganddrop.js"></script>
//                        to include in your application
//Derived from this site: https://www.w3schools.com/html/html5_draganddrop.asp
//
//Allows simple drag and drop of elements to a div space. Also gives functionality to
//aquire elements from each div space and create hidden form fields for exportation
//of arranged data.
var batch = [];

function addToBatch(ev)
{
  var current = ev.target.id;
  if()
  batch.push(current);
  var stuff;
  for(var i = 0; i < batch.length; i++)
  {
    stuff +=batch[i];
  }
  document.getElementById('debug').innerHTML = stuff;
}

function allowDrop(ev)        //tells the element that it should be allowed to recive items
{
  ev.preventDefault();
}

function drag(ev)             //action to take place when user clicks and holds an element
{
  if(batch.length<1)
  {
    ev.dataTransfer.setData("text", ev.target.id);
  }

}

function drop(ev)             //action to take place when user releases mouse button
{
  ev.preventDefault();
  if(batch.length > 0)
  {

  }
  else
  {
    if(!ev.target.getAttribute("ondrop")) //checks to see if element has an 'ondrop' attribute set
      return false;   //if not, then nothing happens. prevents dragged elements to be included in other dragged elements,
                      // which causes issues should a user decide to move an element to another div space. Nesting occures.
    var data = ev.dataTransfer.getData("text");
    //document.getElementById('debug').innerHTML = data;
    ev.target.append(document.getElementById(data));
  }
}

function extractor(input, output)           //When executed this function goes through elements with a class
                                            //  that matches the first argument, and processes through the children.
                                            //  pulls data from the id attribute of the child objects. The id is then passed into
                                            //  a hidden form element which is exported to the element with an id of the second argument.
{
  var groups = document.getElementsByClassName(input);
  var value ="";
  var lable ="";
  var i;
  var j;
  for(j=0; j<groups.length;j++)
  {
    data = groups[j].children;
    lable = "IDs"+j;
    var chunk = "<input name='labels[]' type='hidden' value='"+lable+"'>";

    for(i=0; i<data.length;i++)
    {
      chunk = chunk+"<input name = '"+lable+"[]' type='hidden' value='"+data[i].id+"'>";
    }
    value = value+ chunk;
  }
  document.getElementById(output).innerHTML = value;
}
