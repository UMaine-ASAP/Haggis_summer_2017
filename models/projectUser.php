<?php
Class ProjectUser {
  public $id;
  public $projectID;
  public $userID;
  public $role;
  public $description;
//=================================================================================== STRUCT
  public function __construct($id, $projectID, $userID ,$role, $description) {
        $this->id = $id;
        $this->projectID = $projectID;
        $this->userID = $userID;
        $this->role = $role;
        $this->description = $description;
    }

//=================================================================================== CREATE
    public static function create($projectID, $userID, $role, $description)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO projectUser (projectID, userID, role, description) VALUES (?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($projectID, $userID, $role, $description);
          $stmt->execute($data);
          $projectIDfinal = $db->lastInsertId();

        $errorCode = 1;
        $dataOut = $projectIDfinal;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $dataOut = "Error: ". $e->getMessage();
      }
      return array($errorCode, $dataOut);
    }
//=================================================================================== ALL
    public static function all()
    {
      $courses = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM projectUser";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $courses[]= new ProjectUser($result['projectUserID'], $result['projectID'],$result['userID'],$result['role'],$result['description']);
      }
      return array(1, $courses);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM projectUser WHERE projectUserID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return array(1, new ProjectUser($result['projectUserID'], $result['projectID'],$result['userID'],$result['role'],$result['description']));
    }
//=================================================================================== ID
    public static function assignment($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM projectUser WHERE projectUserID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return array(1, new ProjectUser($result['projectUserID'], $result['projectID'],$result['userID'],$result['role'],$result['description']));
    }
//=================================================================================== ID
    public static function project($id)
    {
      $message;
      $errorCode;
      $localList = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM projectUser WHERE projectID = ?";
      $data = array($id);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $localList[] = new ProjectUser($result['projectUserID'], $result['projectID'],$result['userID'],$result['role'],$result['description']);
        }
        $errorCode = 1;
        $message = $localList;
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
