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
  var index = batch.indexOf(current);
  if(index == -1)
  {
    batch.push(current);
    ev.target.style.border = "1px solid red";
  }
  else
  {
    batch.splice(index, 1);
    ev.target.style.border = "1px solid lightgrey";
  }
}


function allowDrop(ev)        //tells the element that it should be allowed to recive items
{
  ev.preventDefault();
}

function drag(ev)             //action to take place when user clicks and holds an element
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

function drop(ev)             //action to take place when user releases mouse button
{
  ev.preventDefault();
  if(!ev.target.getAttribute("ondrop")) //checks to see if element has an 'ondrop' attribute set
  {
    return false;
  }
  else
  {
    if(batch.length > 0)
    {
      for(var i = 0; i < batch.length; i++)
      {
        ev.target.append(document.getElementById(batch[i]));

      }
      batch = [];
    }
    else
    {
      var data = ev.dataTransfer.getData("text");
      //document.getElementById('debug').innerHTML = data;
      ev.target.append(document.getElementById(data));

    }
  }

}

function move(elementID, destination)
{
  var destinations = document.getElementsByClassName('groupbox');
  destinations[destination].append(document.getElementById(elementID));
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
    lable = groups[j].id;
    var chunk = "<input name='labels[]' type='hidden' value='"+lable+"'>";

    for(i=0; i<data.length;i++)
    {
      chunk = chunk+"<input name = '"+lable+"[]' type='hidden' value='"+data[i].id+"'>";
    }
    value = value+ chunk;
  }
  document.getElementById(output).innerHTML = value;
}


/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);
