$(document).ready(function()
{
  $('#numOfGroups').change(function(){
    multiplier($(this).val(), "#groupboxes");
  });
});


function multiplier(quantity, destination)
{
  var source = "<td class='groupbox' id='group' ondrop='drop(event)' ondragover='allowDrop(event)' style='border:2px solid black'>";
  var output;

  for(var i = 0; i<quantity;i++)
  {
    var numout = i+1;
    output =output + source + "Group " + numout + "</td>";
  }
  $(destination).html(output);

}
