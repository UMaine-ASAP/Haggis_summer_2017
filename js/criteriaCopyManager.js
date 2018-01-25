function loadRubric(event)
{

  var response="";
  var formdata = new FormData();
  formdata.append("rubricID", event.target.value);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('POST', '?controller=assignment&action=getRubric&quick=1',false);
  xmlhttp.onload = function() {
    if (this.status == 200) {
      response = this.responseText;//.replace(/^\s+|\s+$/g, '');
    };
  };
  xmlhttp.send(formdata);
  document.getElementById('criteriaDump').innerHTML = response;
  document.getElementById('copyRubricID').value = event.target.value;
  document.getElementById('rubricviewer').innerHTML = response;
}
