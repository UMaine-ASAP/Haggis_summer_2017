
<table>
  <tr>
    <td id='options' class='options'>
      <h2><?php echo $project->title;?>'s Project</h2>
      <a class='projectitem' onclick='GetProjectResponses(<?php echo $projectid;?>,2)'>View Responses</a>
      <a class='projectitem' onclick='EvaluateProjectEvent(<?php echo $projectid;?>, <?php echo $eventid;?>)'>Give Critique</a>
    </td>
  </tr>
  <tr>
    <td id='FinalView'>
      <?php require_once('contentProject.php');?>
    </td>
  </tr>
</table>
