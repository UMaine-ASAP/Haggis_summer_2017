function getResponse()
{
  var url = "/Haggis_summer_2017/controllers/ajax_controller.php";
  var arr = {proid: $("#testinput").val()};


  $.post(url, arr,

  function(data,status)
  {
    document.getElementById("output").innerHTML = data;
  });
}
