<link rel="stylesheet" type="text/css" href="css/criteria.css">
<link rel="stylesheet" type="text/css" href="css/assignment.css">


<h2>Create an Assignment</h2><hr>

<form action='?controller=assignment&action=createAssignment' method='post'>

<table>
  <tr>
    <td class='assignmentCreationHead' colspan='2'>
      <input class='standard' type='hidden' name='classid' value='<?php echo $class->id; ?>'>
      <input class='standard' type='text' name='title' placeholder='New Assignment' required>
      <input class='standard' name='createnew' type='submit' value='Publish'>
    </td>
  </tr>
  <tr>
    <td class='assignmentCreationGroup' rowspan='2'>
      groups
    </td>
    <td class='assignmentCreation'>
      critiques given between peers on this assignment should be:<br>
      <input type='radio' name='accountability' value='private'>anonymous
      <input type='radio' name='accountability' value='public'>public<br>
      Prompt:<br>
      <textarea class='standard' name='assignmentdescription' cols='100' rows='10' placeholder="Assignment's Description" required></textarea><br>
      Due Date:<input class='standard' type='date' name='duedate' required><br>
      Due Time:<input class='standard' type='time' name='duetime' required><br>
    </td>
  </tr>
  <tr >
    <td class='assignmentCreationCriteria'>
      <br><br>
      <?php echo $criteriaList; ?>
      <?php require_once('views/criteria/criteriacreator.php'); ?>
    </td>
</table>
</form>
<?php echo $criteriaStorage; ?>
