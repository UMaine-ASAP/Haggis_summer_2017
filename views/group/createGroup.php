Create A Group


<script>

function allowDrop(ev)
{
  ev.preventDefault();
}

function drag(ev)
{
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev)
{
  ev.preventDefault();
  if(!ev.target.getAttribute("ondrop"))
    return false;
  var data = ev.dataTransfer.getData("text");
  ev.target.append(document.getElementById(data));
}

function extractor()
{
  var groups = document.getElementsByClassName("div");
  var part ="";
  var i;
  var j;
  for(j=0; j<groups.length;j++)
  {
    data = groups[j].children;
    var value="";
    for(i=0; i<data.length;i++)
    {
      value = value+"<input id = 'userID[]' type='text' value='"+data[i].id+"'><br>";
    }
    var part = part + "<div style='border:1px solid blue'>"+value+"</div>";
  }
  document.getElementById("test").innerHTML = part;
}
</script>
<br>
Group 1
<div class = 'div' id = "group" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black">

</div>
<br>
Group 2
<div class ='div' id = "group" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black">

</div>

<?php
  foreach($userList as $user)
    echo "<p style='border:1px solid red' id = '".$user->id."' draggable='true' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</p>";
?>

<div class='test1' id="test">
  test
</div>

<input id = 'feild' type='text' value=''>

<button type="button" onclick="extractor()">TEST CLICKER</button>
