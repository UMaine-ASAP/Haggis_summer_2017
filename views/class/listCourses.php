<h2>List all Courses</h2>
<table>
  <tr>
    <th>ID          </th>
    <th>Title       </th>
    <th>Course Code </th>
    <th>Description </th>
    <th>Classes     </th>
  </tr>
  <?php foreach($courses as $course) {?>
  <tr>
    <td> <?php echo $course->id; ?></td>
    <td> <?php echo $course->title; ?></td>
    <td> <?php echo $course->code; ?></td>
    <td> <?php echo $course->description; ?></td>
    <td> <?php foreach($course->classes as $klass)
                echo $klass->title."<br>";
                if(sizeof($klass->days) >0)
                foreach($klass->days as $day)

                echo $day."-<br>";}?></td>
  </tr>
</table>
