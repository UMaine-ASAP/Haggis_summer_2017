function NewAssignment(idin)
{
  $('#viewer').load("?controller=assignment&action=createAssignmentQuick&quick=1&classID="+idin);
}
function ViewAssignment(idin, classidin)
{
  $('#viewer').load("?controller=assignment&action=viewAssignment&quick=1&assignmentID="+idin+"&classID="+classidin);
}
function GetProject(idin)
{
  $('#ProjectView').load("?controller=project&action=viewProject&quick=1&projectID="+idin);
}
function GetProjectResponses(idin)
{
  $('#FinalView').load("?controller=project&action=viewResponses&quick=1&id="+idin);
}
function EvaluateProject(idin)
{
  $('#FinalView').load("?controller=project&action=evaluate&quick=1&id="+idin);
}
function GetPrompt(idin)
{
  $('#ProjectView').load("?controller=assignment&action=details&quick=1&id="+idin);
}
