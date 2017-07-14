<?php

class UserPull
{

  public static function all(){					//collects user ID's from Database
    $db = Db::getInstance();
    $sql = "SELECT * FROM user";
    $userList = array();								//used to store User objects
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute();
      while($result = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
      {
        $userList[] = new User($result['userID'], $result['firstName'], $result['middleInitial'], $result['lastName'], $result['email'], $result['userType']);	//and adds a user object with information aquired
      }
      return $userList;			//returns array of User Objects

    }
    catch(PDOException $e)
    {
      echo "Error: ". $e->getMessage();
    }
  }

  public static function id($id){
    $db= Db::getInstance();
    $sql = "SELECT * FROM user WHERE userID = ?";		//Pull from the database anything that matches both email and password
    $data = array($id);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result)																									//if we have a result, we pull data out
      {
        return new User($result['userID'], $result['firstName'],$result['middleInitial'], $result['lastName'], $result['email'], $result['userType']);	//and adds a user object with information aquired
      }
    }
      catch(PDOException $e)
      {
        echo "Error: ". $e->getMessage();
      }

  }
}
?>
