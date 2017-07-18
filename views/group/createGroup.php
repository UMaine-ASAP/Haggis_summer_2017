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
</script>


<div height="25" id = "select1" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black">
Group 1
</div>

<div id = "select2" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black">
Group 2
</div>

<?php
  foreach($userList as $user)
    echo "<p style='border:1px solid red' id = '".$user->id."' draggable='true' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</p>";
?>
