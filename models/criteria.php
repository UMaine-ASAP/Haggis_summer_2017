<?php
class Criteria
{
  public $id;
  public $title;
  public $description;
  public $ratingValue;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $ratingVal)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description=$description;
    $this->ratingValue = $ratingVal;
  }
//=================================================================================== INSERT
  public static function  insert($title, $description, $ratingVal)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO criteria (title, description, ratingValue) VALUES (?,?,?)";
    $stmt = $db->prepare($sql);
    $data = array($title, $description, $ratingVal);
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
          $criteriaArray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['ratingValue']);
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
  //=================================================================================== Get By Criteria SetID
  public static function getByCriSetID($criteriaSetId)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT * FROM criteria WHERE criteriaID IN (SELECT criteriaID FROM criteria_criteriaSet WHERE criteria_criteriaSet.criteriaSetID = ?)";
    $stmt = $db->prepare($sql);
    $data = array($criteriaSetId);
    try
    {
        $stmt->execute($data);
        $criteriaArray = array();
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $criteriaArray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['ratingValue']);
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




    //=================================================================================== Link Criteria to Event
      // public static function associateWithEvent($eventID, $criteriaID)
      // {
      //   {
      //     $errorCode;
      //     $message;
      //     $db = Db::getInstance();
      //     $sql = "INSERT INTO event_criteria (eventID, criteriaID) VALUES (?,?)";
      //     $stmt = $db->prepare($sql);
      //     $data = array($eventID, $criteriaID);
      //     try
      //     {
      //         $stmt->execute($data);
      //         $message = "CriteriaAddedToEvent";
      //         $errorCode= 1;
      //     }
      //     catch(PDOException $e)
      //     {
      //       $errorCode = $e->getCode();
      //       $message = $e->getMessage();
      //     }
      //     return array($errorCode, $message);
      //   }
      // }
  //=================================================================================== Link Set to User

    // public static function associateWithUser($userID, $setID)
    // {
    //   {
    //     $errorCode;
    //     $message;
    //     $db = Db::getInstance();
    //     $sql = "INSERT INTO user_criteriaset (userID, criteriaSetID) VALUES (?,?)";
    //     $stmt = $db->prepare($sql);
    //     $data = array($userID, $setID);
    //     try
    //     {
    //         $stmt->execute($data);
    //         $message = "CriteriaSetAssociatedWithUser";
    //         $errorCode= 1;
    //     }
    //     catch(PDOException $e)
    //     {
    //       $errorCode = $e->getCode();
    //       $message = $e->getMessage();
    //     }
    //     return array($errorCode, $message);
    //   }
    // }
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

            $criteria = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['ratingValue']);

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

            $criteria = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['ratingValue']);

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
              $criteriaarray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['ratingValue']);
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
            $message = "criteria associations have been deleted.";
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
