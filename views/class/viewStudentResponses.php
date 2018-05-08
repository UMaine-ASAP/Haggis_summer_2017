<table>
  <tr>
    <td class='authorList'>
      <h3>Authors</h3>
      <ul>
        <?php
        foreach($userList as $u)
        {
          echo "<li><a href='?controller=evaluate&action=byStudent&classID=".$classID."&authorID=".$u->id."'>".$u->firstName." ".$u->lastName."</a></li>";
        }
        ?>
      </ul>
    </td>
    <td class='authorResults'>
      <?php
        if($selected)
        {
          echo "<h1>".$user->firstName." ".$user->lastName."</h1>";
          $fetchedEvals = Evaluate::byAuthor($user->id)[1];

          if($fetchedEvals !=0)
          {
            echo "<ul>";
            $previousprojectID =-1;
            $currentprojectID;
            foreach($fetchedEvals as $f)
            {
              $currentprojectID = $f->projectID;
              if($currentprojectID != $previousprojectID)
              {
                $currentProject = Project::id($currentprojectID)[1];
                $currentAssignment = Assignment::id($currentProject->assignmentID)[1];
                echo "</ul><li>".$currentAssignment->title." - ".$currentProject->title."</li>";
                if($currentProject->isgroup === '1')
                {
                  echo "<li>";
                  $listing = $currentProject->list;
                  foreach($listing as $u)
                  {
                    echo $u->firstName." ".$u->lastName.", ";
                  }
                }
                echo "<ul>";
              }
              else
              {
                echo "<li>".$f->comment."</li>";
              }

              $previousprojectID = $currentprojectID;
            }
            echo "</ul></ul>";
          }
          else
          {
            echo "User has not submitted any evaluations";
          }
        }
      ?>
    </td>
  </tr>
</table>
