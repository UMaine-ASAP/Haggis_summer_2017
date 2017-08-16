$(document).ready(function()
{
  makeCode(5, "#codebox");
  
  $('#makerandom').click(function(){
    makeCode(5, "#codebox");
  });
});


function makeCode(length,destination)
{
  var code = "";
  var sampleString="0123456789abcdefghijklmnopqrstuvwxyz";

  for(var i = 0; i<length;i++)
  {
    var char = sampleString.charAt(getRandomInt(0,36))
    code += char;
  }
  $(destination).val(code);
}

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
}
