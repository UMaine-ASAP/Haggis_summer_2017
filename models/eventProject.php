
<?php
Class EventProject {
  public $id;
  public $title;
  public $description;
  public $abstract;
  public $projectID;
  public $projectEventCode;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description,$abstract, $projectID, $projectEventCode) {
        $this->id = $id;
        $this->title = $title;
        $this->abstract = $abstract;
        $this->description = $description;
        $this->projectID = $projectID;
        $this->projectEventCode = $projectEventCode;
    }


//=================================================================================== CREATE
    public static function create($title, $description,$abstract, $projectID, $projectEventCode)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO eventProject (title, description, abstract, projectID, projectEventCode) VALUES (?,?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($title, $description,$abstract, $projectID, $projectEventCode);
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
      $sql = "SELECT * FROM eventProject";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $courses[]= new EventProject($result['eventProjectID'],$result['title'],$result['description'],$result['abstract'],$result['projectID'], $result['projectEventCode']);
      }
      return array(1, $courses);
    }
//=================================================================================== ALL
    public static function eventID($eventID)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM eventProject WHERE eventProjectID IN (SELECT eventProjectID FROM event_eventProject WHERE event_eventProject.eventID = ?)";
        $data = array($eventID);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $eventProjectArray = array();
          while($result = $stmt->fetch(PDO::FETCH_ASSOC))
          {

            $eventProjectArray[] = new EventProject($result['eventProjectID'],$result['title'],$result['description'],$result['abstract'],$result['projectID'], $result['projectEventCode']);
          }
          $message = $eventProjectArray;
          $errorCode = 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM eventProject WHERE eventProjectID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $project = new EventProject($result['eventProjectID'],$result['title'],$result['description'],$result['abstract'],$result['projectID'], $result['projectEventCode']);
      return array(1, $project);
    }
//=================================================================================== CREATE
    public static function associatewitheventuser($eventprojectID, $eventUserID)
    {

      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO eventProject_eventUser (eventProjectID, eventUserID) VALUES (?,?)";
      try
      {
        $stmt = $db->prepare($sql);
        $data = array($eventprojectID, $eventUserID);
        $stmt->execute($data);
        $errorCode = 1;
        $dataOut = $db->lastInsertId();
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $dataOut = "Error: ". $e->getMessage();
      }
      return array($errorCode, $dataOut);
    }
//=================================================================================== CREATE
    public static function associatewithevent($eventprojectID, $eventID)
    {

          $errorCode;
          $dataOut;
          $db = Db::getInstance();
          $sql = "INSERT INTO event_eventProject (eventProjectID, eventID) VALUES (?,?)";
          try
          {
            $stmt = $db->prepare($sql);
            $data = array($eventprojectID, $eventID);
            $stmt->execute($data);
            $errorCode = 1;
            $dataOut = $db->lastInsertId();
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $dataOut = "Error: ". $e->getMessage();
          }
          return array($errorCode, $dataOut);
        }

  }
