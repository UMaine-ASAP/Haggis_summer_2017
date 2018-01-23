//use:   <script src="js/draganddrop.js"></script>
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
  var index = batch.indexOf(current);
  if(index == -1)
  {
    batch.push(current);
    ev.target.style.border = "1px solid red";
    ev.target.style.background = "yellow";
  }
  else
  {
    batch.splice(index, 1);
    ev.target.style.border = "1px solid black";
    ev.target.style.background = "white";
  }
}

// ============================================================================================

function allowDrop(ev)        //tells the element that it should be allowed to recive items
{
  ev.preventDefault();
}
// ============================================================================================

function drag(ev)             //action to take place when user clicks and holds an element
{
  var thing = ev.target

  if(thing.getAttribute("draggable") == 'true')
  {
    if(batch.length > 0)
    {
      ev.dataTransfer.setData("text", batch);
    }
    else
    {
      ev.dataTransfer.setData("text", ev.target.id);
    }
  }

}

// ============================================================================================

function cleanUp()
{
  var groupBoxes = document.getElementsByClassName('group');
  var array = [];
  var counter = 0;
  for(var i= 0; i<groupBoxes.length;i++)
  {
    array.push(groupBoxes[i]);
  }
  for(var i = 0; i < array.length; i++)
  {
    if(array[i].innerHTML == '')
      array[i].remove();
    else
    {
      array[i].id = counter;
      counter++;
    }
  }
}
// ============================================================================================

function drop(ev, input, output)             //action to take place when user releases mouse button
{
  ev.preventDefault();
  if(!ev.target.getAttribute("ondrop")) //checks to see if element has an 'ondrop' attribute set
  {
    return false;
  }
  else
  {
    var name = ev.target.id;
    if(name == 'groupMaker')
    {
      var newGroup = $(document.createElement('div'))
      newGroup.addClass('group');
      newGroup.attr('id', '0');
      newGroup.attr('ondrop', 'drop(event,"group","output")');
      newGroup.attr('ondragover', 'allowDrop(event)');
      if(batch.length > 0)
      {
        for(var i = 0; i < batch.length; i++)
        {
          if(document.getElementById(batch[i]) !==null)
          var current = document.getElementById(batch[i]);
          current.style.border = "1px solid black";
          current.style.background = "white";
          newGroup.append(current);

        }
        batch = [];
      }
      else
      {
        var data = ev.dataTransfer.getData("text");
        if(document.getElementById(data) !==null)
        {
          newGroup.append(document.getElementById(data));
        }
      }
      $('#groupmakercontainer').prepend(newGroup);
    }
    else
    {
      if(batch.length > 0)
      {
        for(var i = 0; i < batch.length; i++)
        {
          if(document.getElementById(batch[i]) !==null)
          var current = document.getElementById(batch[i]);
          current.style.border = "1px solid black";
          current.style.background = "white";
          ev.target.append(current);

        }
        batch = [];
      }
      else
      {
        var data = ev.dataTransfer.getData("text");
        if(document.getElementById(data) !==null)
          ev.target.append(document.getElementById(data));
      }
    }
  }
  cleanUp();
  extractor(input, output);
}
// ============================================================================================

function move(elementID, destination)
{
  var destinations = document.getElementsByClassName('groupbox');
  destinations[destination].append(document.getElementById(elementID));
}

Number.prototype.map = function(in_min, in_max, out_min, out_max)
{
  return (this -in_min)*(out_max - out_min) / (in_max-in_min) + out_min;
}
// ============================================================================================

function getRandomInt(min, max) {
    return Math.round(Math.random().map(0,1,min,max));
}
// ============================================================================================

function groupFormer(input, output)
{
  var numberofgroups = document.getElementsByName('numofGroups')[0].value;  //Get the number of groups
  var studentListraw = document.getElementsByClassName('namebutton');       //Get the elements that are students
  var studentList = [];                               //convert DOM node object to an array for manipulation
  for(var i = 0; i < studentListraw.length; i++)
  {
    studentList.push(studentListraw[i]);
  }

  var groupsize = Math.floor(studentList.length/numberofgroups);
  var leftovers = studentList.length%numberofgroups;
  var groups = [];
  for(var i = 0; i<numberofgroups; i++)
  {
    var newGroup = $(document.createElement('div'))
    newGroup.addClass('group');
    newGroup.attr('id', i);
    newGroup.attr('ondrop', 'drop(event,"group","output")');
    newGroup.attr('ondragover', 'allowDrop(event)');
    for(var j = 0; j < groupsize; j++)
    {
        var chooser = getRandomInt(0,studentList.length-1);
        newGroup.append(studentList[chooser]);
        studentList.splice(chooser,1);

    }
    if(numberofgroups-i <= leftovers)
    {
      var chooser2 = getRandomInt(0,studentList.length-1);
      newGroup.append(studentList[chooser2]);
      studentList.splice(chooser2,1);
    }
    $('#groupmakercontainer').prepend(newGroup);
  }
  cleanUp();
  extractor(input, output);
}
// ============================================================================================
function extractor(input, output)
{
  var groups = document.getElementsByClassName(input);
  var value ="";
  var lable ="";
  var i;
  var j;
  for(j=0; j<groups.length;j++)
  {
    data = groups[j].children;
    lable = groups[j].getAttribute("targetuser");
    console.log(lable);

    var chunk = "<input name='labels[]' type='hidden' value='"+lable+"'>";

    for(i=0; i<data.length;i++)
    {
      chunk = chunk+"<input name = '"+lable+"[]' type='hidden' value='"+data[i].id+"'>";
    }
    value = value+ chunk;
  }
  document.getElementById(output).innerHTML = value;
}
