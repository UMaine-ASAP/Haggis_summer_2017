function checkall(input)
{
  var peeps = document.getElementsByClassName(input);
  for(var i=0; i < peeps.length;i++)
  {
    var peep = peeps[i];
      peep.checked = true;
  }
}

function none(input)
{
  var peeps = document.getElementsByClassName(input);
  for(var i=0; i < peeps.length;i++)
  {
    var peep = peeps[i];
    peep.checked = false;
  }
}

function invert(input)
{
  var peeps = document.getElementsByClassName(input);
  for(var i=0; i < peeps.length;i++)
  {
    var peep = peeps[i];
    if(peep.checked)
      peep.checked = false;
    else
      peep.checked = true;
  }
}
