<script src='js/contentSubmissionManager.js'></script>
<input class='standard' id ='projectID' type='hidden' name='projectID' value='<?php echo $projectid;?>'>
<?php
if(isset($assignedUser) && $assignedUser )
{
  echo "<div id='submissionFormContainer'><h4>Make a submission</h4>";
  echo " Link <input class ='typeselect' type='radio' name='type' value='link' checked>";
  echo " File <input class ='typeselect' type='radio' name='type' value='file'>";
  echo " Image <input class ='typeselect' type='radio' name='type' value='image'>";
  echo " Text <input class ='typeselect' type='radio' name='type' value='text'>";
  echo "<div id='submissionForm'>
            <form class='standard' id='contentSubmission' enctype='multipart/form-data' action='' method='post' target='_blank' )'>

            <input class='standard' id ='projectID' type='hidden' name='projectID' value='".$projectid."'>
            <input type='hidden' id='author' name='author' value='".$userID."'>
            <input class='standard' id='contentTitle' type='text' name='contentTitle' placeholder='Title' required><br>
            <input class='standard' id='format' type='hidden' name='format' value='link'>
            <div id='dataentry'>
              <input class='standard' id='data' type='text' name='data' placeholder='http://' required>
            </div>
            <input class='standard' type='button' name='submit'  id='submitContent' value='Submit' onclick='submission()'>
            </form>
        </div>";
  echo "</div>";
}
?> <h3>Project Submissions</h3> <?php
echo "<div class ='error' id='submissionOUTPUT'>";
if(isset($_GET['response']))
{
  echo $_GET['response'];
}
echo "</div>";
echo "<table>";
if(isset($contents) && sizeof($contents) == 0)
  echo "<tr><td>No submissions to show</td></tr>";

else
if(isset($contents))
  foreach($contents as $con)
  {
    echo "<tr><td class='title'>".$con->title."</td></tr><tr>";
    switch($con->format)
    {
      case 'link':
        echo "<td class ='stuff'><a href='".$con->data."'>".$con->data."</a></td>";
        break;
      case 'text':
        echo "<td class ='stuff'>".nl2br($con->data)."</td>";
        break;
      case 'image':
        echo "<td class ='stuff'><a target='_blank' href='".$con->location."'><img src='".$con->location."' width='500'></a></td>";
        break;
      case 'file':
        echo "<td class ='stuff'><a target='_blank' href='".$con->location."'>".$con->data."</a></td>";
        break;
    }
    echo "<td class='by'>Submitted by: ".$con->author->firstName." ".$con->author->lastName." <br>Type: ". $con->format."<br>".$con->date."  ".$con->time;
    if($assignedUser)
      echo "<br><a class='delete' goto='?controller=project&action=delete&quick=1&id=".$con->id."'>Delete";
    echo "</tr>";
  }
echo "</table>";
?>
