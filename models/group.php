<?php
Class Group {
  public $studentGroupID;
  public $projectID;
  public $userIDs;
//=================================================================================== STRUCT
  public function __construct($studentGroupID, $projectID, $userIDs) {
        $this->studentGroupID = $studentGroupID;
        $this->projectID = $projectID;
        $this->userIDs = $userIDs;
    }

//=================================================================================== CREATE
    public static function create($projectID, $userIDs)
 {
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
   }
   catch(PDOException $e)
   {
     echo "Error: " . $e->getMessage()."<br>";
   }
 }
 //=================================================================================== ALL
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
        $groupList[] = new Group($result['studentGroupID'],$result['projectID'],Group::user($result['studentGroupID']) );
      }
      return $groupList;			//returns array of User Objects
    }
    catch(PDOException $e)
    {
      echo "Error: ". $e->getMessage();
    }
  }
//=================================================================================== USER
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
