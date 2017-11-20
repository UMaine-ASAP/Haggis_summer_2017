$(document).ready(function()
{
  $('#numOfMembers').change(function(){
    multiplier($(this).val(), "#membercount");
  });
});


function multiplier(quantity, destination)
{
  var source = "<input type ='text' name=firstName[] placeholder='FirstName'><input type='text' name='middleInitial[]' max='1' placeholder='M'><input type='text' name='lastname[]' placeholder='Last Name'><input type='email' name='email[]' placeholder='Email Address'>";
  var output;

  for(var i = 0; i<quantity;i++)
  {
    var numout = i+1;
    output += source + "<br>";
  }
  $(destination).html(output);

}
