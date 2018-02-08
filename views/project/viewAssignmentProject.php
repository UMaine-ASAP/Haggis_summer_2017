<div class='projectupper'>

      <h2><?php
      if($assignmentType === "submission")
       echo $project->title."'s project";
      else
        echo "Evaluate ".$project->title;
       ?></h2>
       <?php
       if($assignment->privacy == '0')
        echo "<button class='standard projectitem mediumbutton' onclick='GetProjectResponses(<?php echo $project->id;?>,1)'>See Responses</button>";
        ?>
      <button class='standard projectitem mediumbutton' onclick='EvaluateProjectAssignment(<?php echo $project->id;?>)'>Evaluate</button>
</div>


    <div id='FinalView'>
      <?php if($assignmentType === 'submission') require_once('contentProject.php');?>
    </div>
