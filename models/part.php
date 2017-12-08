<?php
Class Part {
  public $id;
  public $title;
  public $description;
  public $contentID;
  public $projectID;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $contentID,$projectID)
  {
      $this->id = $id;
      $this->title = $title;
      $this->description = $description;
      $this->contentID = $contentID;
      $this->projectID = $projectID;
  }
//=================================================================================== CREATE
    public static function create($title, $description, $contentID,$projectID)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO part (title, description, contentID, projectID) VALUES (?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($title, $description, $contentID,$projectID);
          $stmt->execute($data);
          $partIDfinal = $db->lastInsertId();

        $errorCode = 1;
        $dataOut = $partIDfinal;
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
      $parts = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM part";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $parts[]= new Part($result['partID'],$result['title'],$result['description'],$result['contentID'],$result['projectID']);
      }
      return array(1, $parts);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM part WHERE partID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return array(1, new Part($result['partID'],$result['title'],$result['description'],$result['contentID'],$result['projectID']));
    }
  }
  ?>
