<div class='projectupper'>

      <h2><?php
      if($assignmentType === "submission")
       echo $project->title."'s project";
      else
        echo "Evaluate ".$project->title;
       ?></h2>
       <?php
       if($assignment->privacy == '0' || $isadmin)
        echo "<button class='standard projectitem mediumbutton' onclick='GetProjectResponses($project->id,1)'>View Responses</button>";
        ?>
      <button class='standard projectitem mediumbutton' onclick='EvaluateProjectAssignment(<?php echo $project->id;?>)'>Give Critique</button>
</div>


    <div id='FinalView'>
      <?php if($assignmentType === 'submission') require_once('contentProject.php');?>
    </div>
