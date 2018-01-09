$(document).ready(function()
{
  $("#part1").show();
  $("#part1-1").hide();
  $("#part1-2").hide();
  $("#part2").hide();
  $("#part3").hide();
  $("#review").hide();

  var a,b,c,d,e,f,g,h,i,j,k,l,m;

  $("input[type='radio']").click(function(){
      var check = $(this).val();
      if(check =='yes')
      {
        $("#part1-1").slideDown();
        $("#part1-2").slideUp();
        $("#courseError").html(" ");
        $('form[name="createaclass"]').attr("oninput","coursenameout.value=coursename.value+' '+coursecode.value");
      }
      else
      {
        $("#part1-2").slideDown();
        $("#part1-1").slideUp();
        $("#courseError").html(" ");
        $('form[name="createaclass"]').attr("oninput","coursenameout.value=courselisting.id");
      }
  });

  $("button[type='button']").click(function(){
    var check = $(this).val();
    if(check =='backto1')
    {
      $("#part2").slideUp();
      $("#part1").slideDown();
      $("#courseError").html(" ");
    }
    if(check =='backto2')
    {
      $("#part3").slideUp();
      $("#part2").slideDown();
      $("#courseError").html(" ");
    }
    if(check == 'backto3')
    {
      $("#review").slideUp();
      $("#part3").slideDown();
      $("#courseError").html(" ");
    }
    if(check == '1-1')
    {
      a = document.forms['createaclass']['coursetitle'].value;
      b = document.forms['createaclass']['coursecode'].value;
      c = document.forms['createaclass']['coursedescription'].value;
      var msg = "";
      if(a == "")
        msg+= "MissingTitle<br>";
      if(b == "")
        msg+="Missing Code<br>";
      if(c == "")
        msg+="Missing Description <br>";
      if(msg != "")
      {
        $("#courseError").html(msg);
      }
      else
      {
        $("#courseError").html(" ");
        $("#part1").slideUp();
        $("#part2").slideDown();
      }
    }
    else if(check == '1-2')
    {
        $("#part1").slideUp();
        $("#part2").slideDown();
        $("#courseError").html(" ");
    }

    else if(check == '2')
    {
      var msg="";
      e = document.forms['createaclass']['classtitle'].value;
      f = document.forms['createaclass']['classdescription'].value;
      g = document.forms['createaclass']['location'].value;
      h = document.forms['createaclass']['classcode'].value;
      if(e == "")
        msg+= "Missing Title<br>";
      if(f == "")
        msg+="Missing Description<br>";
      if(g == "")
        msg+="Missing Location<br>";
      if(h == "")
        msg+="Missing Join Code<br>";
      if(msg != "")
      {
        $("#courseError").html(msg);
      }
      else
      {
        $("#part2").slideUp();
        $("#part3").slideDown();
        $("#courseError").html(" ");
      }
    }

    else if(check == 'review')
    {
      var msg="";
      i = document.forms['createaclass']['starttime'].value;
      j = document.forms['createaclass']['endtime'].value;
      k = document.forms['createaclass']['startdate'].value;
      l = document.forms['createaclass']['enddate'].value;
      m = document.querySelectorAll('input[type="checkbox"]:checked');
      if(i == "")
        msg+= "Missing Start Time<br>";
      if(j == "")
        msg+="Missing End Time<br>";
      if(k == "")
        msg+="Missing Start Date<br>";
      if(l == "")
        msg+="Missing End Date<br>";
      if(m < 1)
        msg+="No days have been chosen<br>";
      if(msg != "")
      {
        $("#courseError").html(msg);
      }
      else
      {

        //date1 = format(k .getMonth()+1)+"/"+format(k .getDate())+"/"+format(k .getFullYear());
        //date2 = format(l .getMonth()+1)+"/"+format(l .getDate())+"/"+format(l .getFullYear());

        var reviewout = "Name: " + e +"<br>";
        reviewout += "Description: " + f +"<br>";
        reviewout += "Location: " + g +"<br>";
        reviewout += "Time: " + i +" - " + j + "<br>";
        reviewout += "Date: " + k +" - " + l + "<br>";
        reviewout += "Days: ";
        for(var i = 0; i < m.length; i++)
        {
          reviewout+= m[i].value;
          if(i < m.length-1)
          reviewout +=", ";
        }
        reviewout +="<br><br><hr class='minor'> Give this code to your students They will enter it while joining the class: <br><br>";
        reviewout +="Join Code: " + h +"<br><br> (you can access this code later from the class page) ";

        $("#part3").slideUp();
        $("#review").slideDown();
        $("#status").html(reviewout);
        $("#courseError").html(" ");
      }
    }
  })
});
