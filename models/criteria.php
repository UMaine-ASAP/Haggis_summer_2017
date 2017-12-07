<?php
class Criteria
{
  public $id;
  public $title;
  public $description;
  public $minRange;
  public $maxRange;
  public $allowTextResponse;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $minRange, $maxRange, $allowTextResponse)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description=$description;
    $this->minRange = $minRange;
    $this->maxRange = $maxRange;
    $this->allowTextResponse = $allowTextResponse;
  }
//=================================================================================== INSERT
  public static function  insert($title, $description, $minRange, $maxRange, $allowTextResponse)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO criteria (title, description, rateRangeMin, rateRangeMax, allowTextResponse) VALUES (?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $data = array($title, $description, $minRange, $maxRange, $allowTextResponse);
    try
    {
        $stmt->execute($data);
        $message = $db->lastInsertId();
        $errorCode= 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = $e->getMessage();
    }
    return array($errorCode, $message);
  }
//=================================================================================== ALL
  public static function all()
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT * FROM criteria GROUP BY title";
    $stmt = $db->prepare($sql);
    try
    {
        $stmt->execute();
        $criteriaArray = array();
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $criteriaArray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);
        }
        $message = $criteriaArray;
        $errorCode= 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = $e->getMessage();
    }
    return array($errorCode, $message);
  }
//=================================================================================== CREATE CRITERIA SET
  public static function createSet($setName, $setDescription)
  {
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "INSERT INTO criteriaset (title, description) VALUES (?,?)";
      $stmt = $db->prepare($sql);
      $data = array($setName, $setDescription);
      try
      {
          $stmt->execute($data);
          $message = $db->lastInsertId();
          $errorCode= 1;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e->getMessage();
      }
      return array($errorCode, $message);
    }
  }
//=================================================================================== ADD CRITERIA TO A SET
  public static function addToSet($setID, $criteriaID)
  {
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "INSERT INTO criteriaset (criteriaID, criteriaSetID) VALUES (?,?)";
      $stmt = $db->prepare($sql);
      $data = array($setID, $criteriaID);
      try
      {
          $stmt->execute($data);
          $message = "CriteriaAddedToSet";
          $errorCode= 1;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e->getMessage();
      }
      return array($errorCode, $message);
    }
  }
  //=================================================================================== Linke Criteria to Assignment
    public static function associateWithAssignment($assignmentID, $criteriaID)
    {
      {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "INSERT INTO assignment_criteria (assignmentID, criteriaID) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $data = array($assignmentID, $criteriaID);
        try
        {
            $stmt->execute($data);
            $message = "CriteriaAddedToAssignment";
            $errorCode= 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
      }
    }

    //=================================================================================== Link Criteria to Event
      public static function associateWithEvent($eventID, $criteriaID)
      {
        {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql = "INSERT INTO event_criteria (eventID, criteriaID) VALUES (?,?)";
          $stmt = $db->prepare($sql);
          $data = array($eventID, $criteriaID);
          try
          {
              $stmt->execute($data);
              $message = "CriteriaAddedToEvent";
              $errorCode= 1;
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $message = $e->getMessage();
          }
          return array($errorCode, $message);
        }
      }
  //=================================================================================== Link Set to User

    public static function associateWithUser($userID, $setID)
    {
      {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "INSERT INTO user_criteriaset (userID, criteriaSetID) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $data = array($userID, $setID);
        try
        {
            $stmt->execute($data);
            $message = "CriteriaSetAssociatedWithUser";
            $errorCode= 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
      }
    }
    //=================================================================================== GET CRITERIA BY title
      public static function title($title)
      {
          $errorCode;
          $message;
          $criteria;
          $db = Db::getInstance();
          $sql = "SELECT * FROM criteria WHERE title = ?";
          $data = array($id);
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute($data);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            $criteria = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);

            $message = $criteria;
            $errorCode = 1;
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $message = $e->getMessage();
          }
          return array($errorCode, $message);
      }
    //=================================================================================== GET CRITERIA BY id
      public static function id($id)
      {
          $errorCode;
          $message;
          $criteria;
          $db = Db::getInstance();
          $sql = "SELECT * FROM criteria WHERE criteriaID = ?";
          $data = array($id);
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute($data);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            $criteria = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);

            $message = $criteria;
            $errorCode = 1;
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $message = $e->getMessage();
          }
          return array($errorCode, $message);
      }
  //=================================================================================== GET CRITERIA BY ASSIGNMENT
    public static function assignmentID($assignmentid)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM criteria WHERE criteriaID IN (SELECT criteriaID FROM assignment_criteria WHERE assignment_criteria.assignmentID = ?)";
        $data = array($assignmentid);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $criteriaarray = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $criteriaarray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);
          }
          $message = $criteriaarray;
          $errorCode = 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
    }
    //=================================================================================== GET CRITERIA BY ASSIGNMENT
      public static function eventID($id)
      {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql = "SELECT * FROM criteria WHERE criteriaID IN (SELECT criteriaID FROM event_criteria WHERE event_criteria.eventID = ?)";
          $data = array($id);
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute($data);
            $criteriaarray = array();
            while($r = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              $criteriaarray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);
            }
            $message = $criteriaarray;
            $errorCode = 1;
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $message = $e->getMessage();
          }
          return array($errorCode, $message);
      }
    //=================================================================================== DELETE CRITERIA ASSIGNMENT
      public static function deleteAssociation($assignmentID)
      {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql = "DELETE FROM assignment_criteria WHERE assignmentID = ?";
          $data = array($assignmentID);
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute($data);
            $message = "criteria associations have beend deleted.";
            $errorCode = 1;
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $message = "CRITERIA DISASSOCIATION ".$e->getMessage();
          }
          return array($errorCode, $message);
      }
}
