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

          if(sizeof($fetchedEvals) > 0)
          {
            echo "<ul>";
            echo "<<<<".$fetchedEvals.">>>>";
            foreach($fetchedEvals as $f)
            {
              echo "<li>".$f->comment."</li>";
            }
            echo "</ul>";
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
