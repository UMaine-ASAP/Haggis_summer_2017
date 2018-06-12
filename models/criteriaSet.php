<?php
class CriteriaSet
{
  public $id;
  public $title;
  public $description;
  public $ratingMin;
  public $ratingMax;
  public $allowTextResponse;
  public $criterias;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $ratingMin, $ratingMax, $allowTextResponse)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description=$description;
    $this->ratingMin = $ratingMin;
    $this->ratingMax = $ratingMax;
    $this->allowTextResponse = $allowTextResponse;
    $this->criterias = Criteria::getByCriSetID($id)[1];
  }
//=================================================================================== INSERT
  public static function  insert($title, $description, $ratingMin, $ratingMax, $allowTextResponse)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO criteriaSet (title, description, ratingMin, ratingMax, allowTextResponse) VALUES (?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $data = array($title, $description, $ratingMin, $ratingMax, $allowTextResponse);
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
          $criteriaArray[] = new CriteriaSet($r['criteriaSetID'], $r['title'], $r['description'], $r['ratingMin'],$r['ratingMax'],$r['allowTextResponse']);
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
  //=================================================================================== ALL
    public static function id($id)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM criteriaSet WHERE criteriaSetID = ?";
      $stmt = $db->prepare($sql);
      $data = array($id);
      try
      {
          $stmt->execute($data);
          $criteriaArray = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $criteriaArray[] = new CriteriaSet($r['criteriaSetID'], $r['title'], $r['description'], $r['ratingMin'],$r['ratingMax'],$r['allowTextResponse']);
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
  //=================================================================================== ALL
  public static function addCriteriaToSet($criteriaSetId, $criteriaID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO criteria_criteriaSet (criteriaID, criteriaSetID) VALUES (?,?)";
    $stmt = $db->prepare($sql);
    try
    {
      $data = array($criteriaID,$criteriaSetId);
      $stmt->execute($data);
      $message = "Criteria added to CriteriaSet";
      $errorCode= 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = $e->getMessage();
    }
    return array($errorCode, $message);
  }
  //===================================================================================== gets criteria set given class id
  public static function classCriteriaSet($classID)
  {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM criteriaSet WHERE criteriaSetID
        IN (SELECT criteriaSetID FROM rubric_criteriaset WHERE rubric_criteriaset.rubricID
        IN (SELECT rubricID FROM assignment_rubric WHERE assignment_rubric.assignmentID
        IN (SELECT assignmentID FROM assignment_class WHERE assignment_class.classID = ?)))";
      $stmt = $db->prepare($sql);
      $data = array($classID);
      try
      {
          $stmt->execute($data);
          $criteriaArray = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $criteriaArray[] = new CriteriaSet($r['criteriaSetID'], $r['title'], $r['description'], $r['ratingMin'],$r['ratingMax'],$r['allowTextResponse']);
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
  //===================================================================================== GETS CRITERIA SETS FOR ASSIGNMENT
  public static function assignmentCriteriaSet($assignmentID)
  {
    $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM criteriaSet WHERE criteriaSetID
        IN (SELECT criteriaSetID FROM rubric_criteriaset WHERE rubric_criteriaset.rubricID
        IN (SELECT rubricID FROM assignment_rubric WHERE assignment_rubric.assignmentID = ?))";
      $stmt = $db->prepare($sql);
      $data = array($assignmentID);
      try
      {
          $stmt->execute($data);
          $criteriaArray = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $criteriaArray[] = new CriteriaSet($r['criteriaSetID'], $r['title'], $r['description'], $r['ratingMin'],$r['ratingMax'],$r['allowTextResponse']);
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

}
?>
