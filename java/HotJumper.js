function NewAssignment(idin)
{
  $('#viewer').load("?controller=assignment&action=createAssignmentQuick&quick=1&classID="+idin);
}
function ViewAssignment(idin, classidin)
{
  $('#viewer').load("?controller=assignment&action=viewAssignment&quick=1&assignmentID="+idin+"&classID="+classidin);
}
function ViewAssignmentProject(idin, eventid)
{
  $('#viewer').load("?controller=project&action=viewAssignmentProject&quick=1&projectID="+idin+"&eventID="+eventid);
}

function ViewEventProject(idin, eventid)
{
  $('#viewer').load("?controller=project&action=viewEventProject&quick=1&projectID="+idin+"&eventID="+eventid);
}
function GetAssignmentProject(idin)
{
  $('#ProjectView').load("?controller=project&action=viewAssignmentProject&quick=1&projectID="+idin);
}
function GetEventProject(idin)
{
  $('#ProjectView').load("?controller=project&action=viewEventProject&quick=1&projectID="+idin);
}
function GetProjectResponses(idin)
{
  $('#FinalView').load("?controller=project&action=viewResponses&quick=1&id="+idin);
}
function EvaluateProjectAssignment(idin)
{
  $('#FinalView').load("?controller=project&action=assignmentEvaluate&quick=1&id="+idin);
}
function EvaluateProjectEvent(idin, eventid)
{
  $('#FinalView').load("?controller=project&action=eventEvaluate&quick=1&id="+idin+"&eventID="+eventid);
}
function GetPrompt(idin)
{
  $('#ProjectView').load("?controller=assignment&action=details&quick=1&id="+idin);
}
