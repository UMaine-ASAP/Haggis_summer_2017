<?php
class Evaluate
{
  public $id;
  public $criteriaID;
  public $rating;
  public $comment;
  public $projectID;

//=================================================================================== STRUCT
  public function __construct($id, $criteriaID, $rating, $comment, $projectID)
  {
    $this->id = $id;
    $this->criteriaID = $criteriaID;
    $this->rating=$rating;
    $this->comment = $comment;
    $this->projectID = $projectID;
  }
//=================================================================================== INSERT
  public static function  submit($criteriaID, $rating, $comment, $projectID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO evaluation (criteriaID, rating, comment, projectID) VALUES (?,?,?,?)";
    $stmt = $db->prepare($sql);
    $data = array($criteriaID, $rating, $comment, $projectID);
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

   //=================================================================================== GET CRITERIA BY Project
    public static function projectID($projectID)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM evaluation WHERE projectID = ?";
        $data = array($projectID);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $evaluations = array();
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID']);
          }
          $message = $evaluations;
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
