<?php

class GroupPull
{

  public static function all(){					//collects user ID's from Database
    $db = Db::getInstance();
    $sql = "SELECT * FROM studentGroup";
    $groupList = array();								//used to store User objects
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute();
      while($result = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
      {
        $groupList[] = new Group($result['studentGroupID'],$result['projectID'],GroupPull::user($result['studentGroupID']) );
      }
      return $groupList;			//returns array of User Objects
    }
    catch(PDOException $e)
    {
      echo "Error: ". $e->getMessage();
    }
  }

  public static function user($studentGroupID)
  {
    $db = Db::getInstance();
    $sql = "SELECT * FROM user_studentGroup WHERE studentGroupID = ?";
    $userlist =array();
    try
    {
      $stmt = $db->prepare($sql);
      $data = array($studentGroupID);
      $stmt->execute($data);
      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $userlist[] = $result['userID'];
      }
      return $userlist;
    }
    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
  }
}
?>
