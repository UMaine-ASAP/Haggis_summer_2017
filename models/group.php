<?php
Class Group {
  public $studentGroupID;
  public $projectID;
  public $users;
//=================================================================================== STRUCT
  public function __construct($studentGroupID, $projectID, $users)
  {
    $this->studentGroupID   = $studentGroupID;
    $this->projectID        = $projectID;
    $this->users          = $users;
  }
//=================================================================================== CREATE
  public static function create($projectID, $userIDs)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO studentGroup (projectID) VALUES (?)";
    $data = array($projectID);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $studentgroupID = $db->lastInsertId();
      $sql = "INSERT INTO user_studentGroup (userID, studentGroupID) VALUES (?,?)";
      $stmt = $db->prepare($sql);
      foreach($userIDs as $id)
      {
        $data = array($id, $studentgroupID);
        $stmt->execute($data);
      }
      $errorCode = 1;
      $message = "Groups successfully Created";
    }
    catch(PDOException $e)
    {
      $errorCode  = $e-> getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
 }

 //=================================================================================== GET BY PROJECT ID
  public static function getByProjectID($projectID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT * FROM studentGroup WHERE projectID = ?";
    $data = array($projectID);
    $groupList;								//used to store Group objects
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      while($result = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
      {
        $userIDs = Group::user($result['studentGroupID'])[1];
        $users = array();
        foreach($userIDs as $uid)
        {
          $users[] = User::id($uid)[1];
        }
        $groupList[] = new Group($result['studentGroupID'],$result['projectID'],$users );
      }
      $errorCode  = 1;
      $message    = $groupList;
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
  }
 //=================================================================================== GET PROJECT IDs
  public static function getProjectIDs()
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT DISTINCT projectID FROM studentGroup";
    try
    {
      $stmt = $db->prepare($sql);
      $data = array();
      $result = $stmt->execute($data);
      $errorCode  = 1;
      $message    = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }

    return array($errorCode, $message);
  }
//=================================================================================== ALL
  public static function all()
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT * FROM studentGroup";
    $groupList = array();								//used to store User objects
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute();
      while($result = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
      {
        $userIDs = Group::user($result['studentGroupID'])[1];
        $users = array();
        foreach($userIDs as $uid)
        {
          $users[] = User::id($uid)[1];
        }
        $groupList[] = new Group($result['studentGroupID'],$result['projectID'],$users );
      }
      $errorCode  = 1;
      $message    = $groupList;
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
  }
//=================================================================================== USER
  public static function user($studentGroupID)
  {

    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT userID FROM user_studentGroup WHERE studentGroupID = ?";
    $userlist =array();
    try
    {
      $stmt = $db->prepare($sql);
      $data = array($studentGroupID);
      $stmt->execute($data);
      $userlist = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
      $errorCode  = 1;
      $message    = $userlist;
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
  }
}
?>
