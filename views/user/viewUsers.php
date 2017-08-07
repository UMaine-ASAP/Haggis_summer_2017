<h2>Registered Users</h2>

<div>
  <table>
    <tr>
      <td>
        There are <?php echo sizeof($results); ?> registered users.
      </td>
    </tr>
    <tr>
      <th>
        UserID
      </th>
      <th>
        UserType
      </th>
      <th>
        First Name
      </th>
      <th>
        LastName
      </th>
    </tr>
    <?php foreach($results as $result) { ?>
    <tr>
      <td>
        <?php echo $result->id;?>
      </td>
      <td>
        <?php echo $result->usertype;?>
      </td>
      <td>
        <?php echo $result->firstName;?>
      </td>
      <td>
        <?php echo $result->lastName; }?>
      </td>
    </tr>
