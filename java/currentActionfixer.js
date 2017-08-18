function fixer(destination, title, subtext)
{

  var output = "<h2>"+title+"</h2>";

  output += subtext;

  $(destination).html(output);

}
