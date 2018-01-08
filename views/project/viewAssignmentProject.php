<div class='projectupper'>
      <h2><?php echo $project->title;?>'s Project</h2>
      <button class='standard projectitem' onclick='GetProjectResponses(<?php echo $project->id;?>,1)'>See Responses</button>
      <button class='standard projectitem' onclick='EvaluateProjectAssignment(<?php echo $project->id;?>)'>Evaluate Project</button>
</div>
    <div id='FinalView'>
      <?php require_once('contentProject.php');?>
    </div>
