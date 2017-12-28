<div class='projectupper'>
      <h2><?php echo $project->title;?>'s Project</h2>
      <a class='projectitem' onclick='GetProjectResponses(<?php echo $project->id;?>,1)'>See Responses</a>
      <a class='projectitem' onclick='EvaluateProjectAssignment(<?php echo $project->id;?>)'>Evaluate Project</a>
</div>
    <div id='FinalView'>
      <?php require_once('contentProject.php');?>
    </div>
