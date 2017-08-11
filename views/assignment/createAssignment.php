<h2>Create an Assignment</h2>

<form action='?controller=assignment&action=createAssignment' method='post'>
  <input type='text' name='title' placeholder="Assignment's title"><br>
  <textarea name='description' cols=25 rows=10 placeholder="Assignment's Description"></textarea><br>
  Due Date:<input type='date' name='duedate'><br>
  Due Time:<input type='time' name='duetime'><br>
  <input type='submit' value='Add Assignment'>
</form>
