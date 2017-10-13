<?php
Class Project {
  public $id;
  public $title;
  public $isgroup;
  public $description;
  public $assignmentID;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description,$isgroupin, $assignmentIDin) {
        $this->id = $id;
        $this->title = $title;
        $this->isgroup = $isgroupin;
        $this->description = $description;
        $this->assignmentID = $assignmentIDin;
    }


//=================================================================================== CREATE
    public static function create($title, $isgroup, $description, $assignmentID)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO project (title, description, isGroup, assignmentID) VALUES (?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($title, $description, $isgroup, $assignmentID);
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
      $sql = "SELECT * FROM project";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $courses[]= new Project($result['projectID'],$result['title'],$result['description'],$result['isgroup'],$result['assignmentID']);
      }
      return array(1, $courses);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM project WHERE projectID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return array(1, new Project($result['projectID'],$result['title'],$result['description'],$result['isgroup'],$result['assignmentID']);
    }


  }
  ?>
