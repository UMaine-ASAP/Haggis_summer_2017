<?php
class Assignment
{
  public $id;
  public $title;
  public $description;
  public $duetime;
  public $duedate;
  public $rubric;
  public $projects;
  public $type;
  public $classID;
  public $assigned;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $duetime, $duedate, $projectsin, $typein, $assignedin)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description=$description;
    $this->duetime = date_format(date_create($duetime), 'g:i a');
    $this->duedate = date_format(date_create($duedate), 'm/d/Y');
    $this->rubric = Rubric::assignmentID($id)[1];
    $this->projects = $projectsin;
    $this->type = $typein;
    $this->classID = Assignment::getClassID($id)[1];
    $this->assigned = $assignedin;
  }

//=================================================================================== INSERT ASSIGNMENT
  public static function create($title, $description, $duetime, $duedate, $classid, $type, $assigned)
  {
    $errorCode;
    $message;
    $db= Db::getInstance();
    $sql = "INSERT INTO assignment(title, description, dueTime, dueDate, assignmentType, assignedFlag) VALUES(?,?,?,?,?,?)";
    $data = array($title, $description, $duetime, $duedate,$type, $assigned);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $assignmentid = $db->lastInsertId();
      Assignment::linkToClass($classid, $assignmentid);
      $message = $assignmentid;
      $errorCode = 1;

    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = $e->getMessage();
    }
    return array($errorCode, $message);

  }

//=================================================================================== ASSOCIATE WITH CLASS
public static function linkToClass($classID, $assignmentID)
{
  $errorCode;
  $message;
  $db = Db::getInstance();
  $sql ="INSERT INTO assignment_class(classID, assignmentID) VALUES(?,?)";
  $data = array($classID, $assignmentID);
  try
  {
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    $message = "succsses";
    $errorCode = 1;
  }
  catch(PDOException $e)
  {
    $errorCode = $e->getCode();
    $message = $e->getMessage();
  }
  return array($errorCode, $message);
}
//=================================================================================== GET ASSIGNMENT by ID
  public static function id($id)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT * FROM assignment WHERE assignmentID = ?";
    $data = array($id);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $errorCode = 1;
      $message = new Assignment($r['assignmentID'], $r['title'], $r['description'],$r['dueTime'],$r['dueDate'], Project::assignment($r['assignmentID'])[1], $r['assignmentType'], $r['assignedFlag']);
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = $e->getMessage();
    }
    return array($errorCode, $message);
  }
  //=================================================================================== all
    public static function all()
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM assignment";
      try
      {

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $assignmentarray = array();
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $assignmentarray[] = new Assignment($r['assignmentID'], $r['title'], $r['description'],$r['dueTime'],$r['dueDate'],Project::assignment($r['assignmentID'])[1], $r['assignmentType'], $r['assignedFlag']);
        }
        $message = $assignmentarray;
        $errorCode = 1;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e->getMessage();
      }
      return array($errorCode, $message);
    }
  //=================================================================================== byClass
    public static function classid($classid)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM assignment WHERE assignmentID IN (SELECT assignmentID FROM assignment_class WHERE assignment_class.classID = ?)";
        $data = array($classid);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $assignmentarray = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {

            $assignmentarray[] = new Assignment($r['assignmentID'], $r['title'], $r['description'],$r['dueTime'],$r['dueDate'],Project::assignment($r['assignmentID'])[1], $r['assignmentType'], $r['assignedFlag']);
          }
          $message = $assignmentarray;
          $errorCode = 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
    }
  //=================================================================================== DELETE CLASS
  public static function delete($assignmentID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "DELETE FROM assignment WHERE assignmentID = ?";
    $data = array($assignmentID);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      Criteria::deleteAssociation($assignmentID);
      $message = "assignment deleted";
      $errorCode = 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = "ASSIGNMENT DELETION ".$e->getMessage();
    }
    return array($errorCode, $message);
  }
  //=================================================================================== DELETE CLASS
  public static function getClassID($assignmentID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT classID FROM assignment_class WHERE assignmentID = ?";
    $data = array($assignmentID);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $message = $r['classID'];
      $errorCode = 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = "ASSIGNMENT DELETION ".$e->getMessage();
    }
    return array($errorCode, $message);
  }
  //===================================================================================
  public static function updateAssigned($status, $assignmentID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "UPDATE assignment SET assignedFlag = ? WHERE assignmentID = ?";
    $data = array($status, $assignmentID);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $message = "updated";
      $errorCode = 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = "ASSIGNMENT DELETION ".$e->getMessage();
    }
    return array($errorCode, $message);
  }

}
