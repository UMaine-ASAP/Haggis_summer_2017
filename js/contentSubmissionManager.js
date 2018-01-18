function submission()
{
  var data;
  var projectID = document.getElementById('projectID').value;
  var author = document.getElementById('author').value;
  var contentTitle = document.getElementById('contentTitle').value;
  var format = document.getElementById('format').value;
  switch(format)
  {
    case 'link':
      data = document.getElementById('data').value;
      break;
    case 'text':
      data = document.getElementById('data').value;
      break;
    case 'image':
      data = document.getElementById('data').files[0];
      break;;
    case 'file':
      data = data = document.getElementById('data').files[0];
      break;
  }
  if(contentTitle == "" || data == "" || data == null)
  {
    document.getElementById('submissionOUTPUT').innerHTML = "Please fill in all fields";
  }
  else
  {
    var response;
    var formdata = new FormData();
    formdata.append("data", data);
    formdata.append("projectID", projectID);
    formdata.append("author", author);
    formdata.append("contentTitle", contentTitle);
    formdata.append("format", format);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('POST', '?controller=project&action=submit&quick=1',false);
    xmlhttp.upload.onprogress = function(e) {
      if (e.lengthComputable) {
        var percentComplete = (e.loaded / e.total) * 100;
        console.log(percentComplete + '% uploaded');
      }
    };
    xmlhttp.onload = function() {
      if (this.status == 200) {
        response = this.responseText.replace(/^\s+|\s+$/g, '');
      };
    };
    xmlhttp.send(formdata);
    $('#ProjectView').load("?controller=project&action=viewAssignmentProject&quick=1&projectID="+projectID+"&type=submission&response="+encodeURI(response));

  }

}

$(document).ready(function()
{
  $('.typeselect').on('click',function()
  {
    if($(this).val() ==='file')
    {
      $('#dataentry').html("<input class='standard' id='data' type='file' name='data' style='margin: 0 auto' required>");
      $('#format').val('file');
    }
    if($(this).val() ==='link')
    {
      $('#dataentry').html("<input class='standard' id='data' type='text' name='data' placeholder='http://' required>");
      $('#format').val('text');
    }
    if($(this).val() ==='image')
    {
      $('#dataentry').html("<input class='standard' id='data' type='file' name='data' style='margin: 0 auto' required>");
      $('#format').val('image');
    }
    if($(this).val() ==='text')
    {
      $('#dataentry').html("<textarea class='standard' id='data' name='data' cols='75' rows='15' required></textarea>");
      $('#format').val('text');
    }
  });

  $('.delete').on('click', function()
  {
    if(confirm("Are you sure you wish to delete this submission?"))
    {
      var deletelink = $(this).attr('goto');
      var projectID = $('#projectID').val();
      $('#ProjectView').load(deletelink);
      $('#ProjectView').load("?controller=project&action=viewAssignmentProject&quick=1&projectID="+projectID+"&type=submission");
    }
  });

});
