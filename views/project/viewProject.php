
<table>
  <tr>
    <td id='options' class='options'>
      <h2><?php echo $project->title;?>'s Project</h2>
      <a class='projectitem' onclick='GetProjectResponses(<?php echo $projectid;?>)'>See Responses</a>
      <a class='projectitem' onclick='EvaluateProject(<?php echo $projectid;?>)'>Evaluate Project</a>
    </td>
  </tr>
  <tr>
    <td id='FinalView'>
      <?php require_once('contentProject.php');?>
    </td>
  </tr>
</table>
