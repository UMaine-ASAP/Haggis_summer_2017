

function charting()
{
    //var data = [1.5, 3.3, 6, 4.1, 8.9];
    for(var i = 0; i < thisdata.length; i++)
    {
      if(thisdata[i] == -1)
      {
        thisdata.splice(i,1);
      }
    }
    var data = thisdata;
    d3.select(".chart")
      .selectAll("div")
      .data(data)
        .enter()
        .append("div")
        .style("width", function(d) {return d+(3.72/5)+ "%";})
        .text(function(d){return d;});
}
