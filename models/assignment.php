<?php
class Assignment
{
  public $id;
  public $title;
  public $description;
  public $duetime;
  public $duedate;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $duetime, $duedate)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description=$description;
    $this->duetime = $duetime;
    $this->duedate = $duedate;
  }

//=================================================================================== INSERT ASSIGNMENT
  public static function create($title, $description, $duetime, $duedate)
  {
    $errorCode;
    $message;
    $db= Db::getInstance();
    $sql = "INSERT INTO assignment(title, description, dueTime, dueDate) VALUES(?,?,?,?)";
    $data = array($title, $description, $duetime, $duedate);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $message = $db->lastInsertId();
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
      $message = new Assignment($r['assignmentID'], $r['title'], $r['description'],$r['dueTime'],$r['dueDate']);
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
          $assignmentarray[] = new Assignment($r['assignmentID'], $r['title'], $r['description'],$r['dueTime'],$r['dueDate']);
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
      // public static function id($id)
      // {
      //   $errorCode;
      //   $message;
      //   $db = Db::getInstance();
      //   $sql = "SELECT * FROM assignment WHERE assignmentID = ?";
      //   $data = array($id);
      //   try
      //   {
      //     $stmt = $db->prepare($sql);
      //     $stmt->execute($data);
      //     $r = $stmt->fetch(PDO::FETCH_ASSOC);
      //     $errorCode = 1;
      //     $message = new Assignment($r['assignmentID'], $r['title'], $r['description'],$r['dueTime'],$r['dueDate']);
      //   }
      //   catch(PDOException $e)
      //   {
      //     $errorCode = $e->getCode();
      //     $message = $e->getMessage();
      //   }
      //   return array($errorCode, $message);
      // }
    }
}
