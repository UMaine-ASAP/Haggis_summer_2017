
// $(document).ready(function()
// {
//   $(document).on("click","#NewAssignment",function()
//   {
//
//   });
// });

function NewAssignment(idin)
{
  //var url = "/Haggis_summer_2017/views/assignment/createAssignment.php";
  //var arr = {proid: $("#testinput").val()};

  //$("#contents").load("home.php", function(response, status, xhr) {


    $('#viewer').load("/Haggis_summer_2017/controllers/createAssignmentController.php?classID="+idin);

}

function ViewAssignment(idin)
{
    $('#viewer').load("/Haggis_summer_2017/controllers/fetchAssignmentController.php?assignmentID="+idin);
}

  // $.post(url, arr,
  //
  // function(data,status)
  // {

  //});
