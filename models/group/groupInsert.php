<?php

class GroupInsert
{
  public static function group($projectID, $userIDs)
  {
    $db = Db::getInstance();
    $sql = "INSERT INTO studentgroup (projectID) VALUES (?)";
    $data = array($projectID);

    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $studentgroupID = $db->lastInsertId();
      $sql = "INSERT INTO user_studentgroup (userID, studentGroupID) VALUES (?,?)";
      $stmt = $db->prepare($sql);

      foreach($userIDs as $id)
      {
        $data = array($id, $studentgroupID);
        $stmt->execute($data);
      }
    }
    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
  }

}

?>
