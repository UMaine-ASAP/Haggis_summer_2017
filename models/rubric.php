<?php
class Rubric
{
  public $id;
  public $title;
  public $description;
  public $author;
  public $criteriaSets;
  //=================================================================================== STRUCT
    public function __construct($id, $title, $description, $author)
    {
      $this->id           = $id;
      $this->title        = $title;
      $this->description  = $description;
      $this->author       = $author;
      $this->criteriaSets = Rubric::getCriteriaSets($id)[1];

    }
  //=================================================================================== INSERT
    public static function  create($title, $description, $author)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "INSERT INTO rubric (title, description, author) VALUES (?,?,?)";
      $data = array($title, $description, $author);
      $stmt = $db->prepare($sql);
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
  //=================================================================================== getCriteriaSets
    public static function  getCriteriaSets($rubricID)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM criteriaset WHERE criteriasetID IN (SELECT criteriasetID FROM rubric_criteriaset WHERE rubric_criteriaset.rubricID = ?)";
      $stmt = $db->prepare($sql);
      $data = array($rubricID);
      $criteriaSets = array();
      try
      {

          $stmt->execute($data);
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $criteriaSets[] = new CriteriaSet($r['criteriasetID'], $r['title'],$r['description'],$r['ratingMin'],$r['ratingMax'],$r['allowTextResponse']);
          }
          $message = $criteriaSets;
          $errorCode= 1;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e->getMessage();
      }
      return array($errorCode, $message);
    }
  //=================================================================================== INSERT
    public static function  associateWithRubric($rubricID,$criteriaSetID)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "INSERT INTO rubric_criteriaset (rubricID, criteriasetID) VALUES (?,?)";
      $data = array($rubricID,$criteriaSetID);
      $stmt = $db->prepare($sql);
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
  //=================================================================================== Linke Criteria to Assignment
    public static function associateWithAssignment($assignmentID, $rubricID)
    {
      {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "INSERT INTO assignment_rubric (assignmentID, rubricID) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $data = array($assignmentID, $rubricID);
        try
        {
            $stmt->execute($data);
            $message = "RubricAddedToAssignment";
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
    public static function associateWithEvent($eventID, $rubricID)
    {
      {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "INSERT INTO event_rubric (eventID, rubricID) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $data = array($eventID, $rubricID);
        try
        {
            $stmt->execute($data);
            $message = "RubricAddedToEvent";
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
    public static function id($rubricID)
    {
      {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM rubric WHERE rubricID = ?";
        $stmt = $db->prepare($sql);
        $data = array($rubricID);
        try
        {
            $stmt->execute($data);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            $message = new Rubric($r['rubricID'],$r['title'],$r['description'],$r['author']);
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
  //=================================================================================== GET CRITERIA BY ASSIGNMENT
    public static function assignmentID($assignmentid)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM rubric WHERE rubricID IN (SELECT rubricID FROM assignment_rubric WHERE assignment_rubric.assignmentID = ?)";
        $data = array($assignmentid);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $r = $stmt->fetch(PDO::FETCH_ASSOC);



          $message = new Rubric($r['rubricID'],$r['title'],$r['description'],$r['author']);;
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
    public static function eventID($eventID)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM rubric WHERE rubricID IN (SELECT rubricID FROM event_rubric WHERE event_rubric.eventID = ?)";
        $data = array($eventID);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $r = $stmt->fetch(PDO::FETCH_ASSOC);
          $message = new Rubric($r['rubricID'],$r['title'],$r['description'],$r['author']);;
          $errorCode = 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
    }

}

?>
