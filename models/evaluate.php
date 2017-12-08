<?php
class Evaluate
{
  public $id;
  public $criteriaID;
  public $rating;
  public $comment;
  public $projectID;
  public $eventProjectID;
  public $author;
  public $type;
  public $criteria;

//=================================================================================== STRUCT
  public function __construct($id, $criteriaID, $rating, $comment, $projectID, $eventProjectID, $authorID, $type)
  {
    $this->id = $id;
    $this->criteriaID = $criteriaID;
    $this->rating=$rating;
    $this->comment = $comment;
    $this->projectID = $projectID;
    $this->eventProjectID = $eventProjectID;
    $this->author = $authorID;
    $this->type = $type;
    $this->criteria = Criteria::eventID($id)[1];
  }
//=================================================================================== INSERT/UPDATE
  public static function  submit($criteriaID, $rating, $comment, $targetID, $authorID,$type)
  {
    $errorCode;
    $message;
    $data;
    $sql;
    $db = Db::getInstance();
    $check = Evaluate::check($authorID, $targetID, $criteriaID)[1];
    if($type === '1')
    {
      $sql = "INSERT INTO evaluation (criteriaID, rating, comment, projectID, author, type) VALUES (?,?,?,?,?,?)";
      $data = array($criteriaID, $rating, $comment, $targetID, $authorID,$type);
    }
    if($type === '2')
    {
      $sql = "INSERT INTO evaluation (criteriaID, rating, comment, eventProjectID, author, type) VALUES (?,?,?,?,?,?)";
      $data = array($criteriaID, $rating, $comment, $targetID, $authorID,$type);
    }
    if($check)
    {
      $sql = "UPDATE evaluation SET  rating = ?, comment = ? WHERE evaluationID = ?";
      $data = array($rating, $comment,$check);
    }
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
            $author = User::id($r['author'])[1];

            $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'], $author, $r['type']);
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
    //=================================================================================== GET CRITERIA BY Project
     public static function eventProjectID($eventProjectID)
     {
         $errorCode;
         $message;
         $db = Db::getInstance();
         $sql = "SELECT * FROM evaluation WHERE eventProjectID = ?";
         $data = array($eventProjectID);
         try
         {
           $stmt = $db->prepare($sql);
           $stmt->execute($data);
           $evaluations = array();
           while($r = $stmt->fetch(PDO::FETCH_ASSOC))
           {
             $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'], "anonymous", $r['type']);
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
    //=================================================================================== Check if already submitted
     public static function check($authorid, $projectid, $criteriaid)
     {
         $errorCode;
         $message;
         $db = Db::getInstance();
         $sql = "SELECT * FROM evaluation WHERE author = ? AND projectID = ? AND criteriaID = ?";
         $data = array($authorid, $projectid, $criteriaid);
         try
         {
           if($authorid ==='-1')
           {
             $message = false;
           }
           else
           {
             $stmt = $db->prepare($sql);
             $stmt->execute($data);
             $evaluations = array();
             $message = false;
             if($r = $stmt->fetch(PDO::FETCH_ASSOC))
             {
               $message = $r['evaluationID'];
             }
             //$message = $evaluations;
           }
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
