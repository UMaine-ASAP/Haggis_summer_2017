<?php
class Evaluate
{
  public $id;
  public $criteriaID;
  public $rating;
  public $comment;
  public $projectID;
  public $eventProjectID;
  public $userID;
  public $author;
  public $type;
  public $criteria;

//=================================================================================== STRUCT
  public function __construct($id, $criteriaID, $rating, $comment, $projectID, $eventProjectID, $userID, $authorID, $type)
  {
    $this->id = $id;
    $this->criteriaID = $criteriaID;
    $this->rating=$rating;
    $this->comment = $comment;
    $this->projectID = $projectID;
    $this->eventProjectID = $eventProjectID;
    $this->userID  = $userID;
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
    $check = Evaluate::check($authorID, $targetID, $criteriaID, $type)[1];
    if($type === '1')
    {
      if($check)
      {
        $sql = "UPDATE evaluation SET  rating = ?, comment = ? WHERE evaluationID = ?";
        $data = array($rating, $comment,$check);
      }
      else
      {
        $sql = "INSERT INTO evaluation (criteriaID, rating, comment, projectID, author, type) VALUES (?,?,?,?,?,?)";
        $data = array($criteriaID, $rating, $comment, $targetID, $authorID,$type);
      }
    }
    else if($type === '2')
    {
      $sql = "INSERT INTO evaluation (criteriaID, rating, comment, eventProjectID, author, type) VALUES (?,?,?,?,?,?)";
      $data = array($criteriaID, $rating, $comment, $targetID, $authorID,$type);
    }
    else if($type === '3')
    {
      if($check)
      {
        $sql = "UPDATE evaluation SET  rating = ?, comment = ? WHERE evaluationID = ?";
        $data = array($rating, $comment,$check);
      }
      else
      {
        $sql = "INSERT INTO evaluation (criteriaID, rating, comment, userID, author, type) VALUES (?,?,?,?,?,?)";
        $data = array($criteriaID, $rating, $comment, $targetID, $authorID,$type);
      }
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
      $message = $e->getMessage()."<br>".$stmt->debugDumpParams();
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

            $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'],$r['userID'], $author, $r['type']);
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
    //=================================================================================== Get all evaluations for a class given the classID
    public static function classEvaluations($classID)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM evaluation WHERE projectID IN (SELECT projectID FROM project WHERE assignmentID IN (SELECT assignmentID FROM assignment_class WHERE assignment_class.classID = ?))";
      $data = array($classID);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $evaluations = array();
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $author = User::id($r['author'])[1];

          $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'],$r['userID'], $author, $r['type']);
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
    //=================================================================================== GET EVALUATIONS BY ASSIGNMENT PER GROUP
    public static function assignmentGroupEvaluations($assignmentID)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM evaluation WHERE projectID IN
      (SELECT projectID FROM project WHERE assignmentID = ?)";
      $data = array($assignmentID);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $evaluations = array();
        $key = 1;
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $author = User::id($r['author'])[1];
          $authorName;
          if($r['author'] == -1)
          {
            $authorName = "Anonymous ".$key;
          }
          else
          {
            $authorName = $author->firstName." ".$author->middleInitial." ".$author->lastName;
          }
          $criteria = CriteriaSet::id($r['criteriaID'])[1][0];
          $project = Project::id($r['projectID'])[1];

          $evaluations[] = [
              "rating" => $r['rating'],
              "ratingMax" => $criteria->ratingMax,
              "comment" => $r['comment'],
              "authorID" => $r['author'],
              "author" => $authorName,
              "groupTitle" => $project->title,
              "groupID" => Group::getGroupID($r['projectID'])[1],
              "criteriaTitle" => $criteria->title,
              "criteriaID" => $r['criteriaID']
            ];

          $key++;
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
    //=================================================================================== GET AVERAGE RATING OF GROUP SEPERATED BY CRITERIA
    public static function averageRating($groupID, $criteriaID)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM evaluation WHERE projectID IN(SELECT projectID FROM studentGroup WHERE studentgroup.studentGroupID = ?) AND criteriaID = ?";
      $data = array($groupID, $criteriaID);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $evaluations = array();
        $ratingTotal = 0;
        $counter = 0;

        while($r = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $ratingTotal += $r['rating'];
          $counter++;
        }

        if($counter > 0)
          $averageRating = $ratingTotal/$counter;
        else
          $averageRating = 0;

        $message = $averageRating;
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
             $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'],$r['userID'], "anonymous", $r['type']);
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
     public static function check($authorid, $targetID, $criteriaid, $type)
     {
         $errorCode;
         $message;
         $db = Db::getInstance();
         $sql;
         switch($type)
         {
           case '1':
            $sql = "SELECT * FROM evaluation WHERE author = ? AND projectID = ? AND criteriaID = ?";
            break;
          case '2':
            $sql = "SELECT * FROM evaluation WHERE author = ? AND projectID = ? AND criteriaID = ?";
            break;
          case '3':
            $sql = "SELECT * FROM evaluation WHERE author = ? AND userID = ? AND criteriaID = ?";
            break;
         }

         $data = array($authorid, $targetID, $criteriaid);
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

     //=================================================================================== Check if already submitted
      public static function getEvaluated($authorid, $type)
      {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql;
          $peer = false;
          switch($type)
          {
            case '1':
             $sql = "SELECT DISTINCT projectID FROM evaluation WHERE author = ?";
             break;
           case '2':
             $sql = "SELECT DISTINCT projectID FROM evaluation WHERE author = ?";
             break;
           case '3':
             $sql = "SELECT DISTINCT userID FROM evaluation WHERE author = ?";
             $peer = true;
             break;
          }

          $data = array($authorid);
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
              $projectIDs = array();
              $message = false;
              while($r = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                if($peer)
                {
                  $projectIDs[] = $r['userID'];
                }
                else
                {
                  $projectIDs[] = $r['projectID'];
                }
              }
              $message = $projectIDs;
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
     //=================================================================================== Check if already submitted
      public static function getPrexisting($authorid, $projectID)
      {
          $errorCode;
          $message;
          $db = Db::getInstance();

          $sql = "SELECT * FROM evaluation WHERE author = ? AND projectID = ?";

          $data = array($authorid, $projectID);
          try
          {

              $stmt = $db->prepare($sql);
              $stmt->execute($data);

              if($stmt->rowCount() > 0)
              {
                //$id, $criteriaID, $rating, $comment, $projectID, $eventProjectID, $userID, $authorID, $type)
                $evaluations = array();

                while($r = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                  $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'],$r['userID'], $r['author'], $r['type']);
                }
                $message = $evaluations;
              }
              else
              {
                $message = false;
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
      //=================================================================================== Check if already submitted
       public static function byAuthor($authorid)
       {
           $errorCode;
           $message;
           $db = Db::getInstance();

           $sql = "SELECT * FROM evaluation WHERE author = ?";

           $data = array($authorid);
           try
           {

               $stmt = $db->prepare($sql);
               $stmt->execute($data);

               if($stmt->rowCount() > 0)
               {
                 //$id, $criteriaID, $rating, $comment, $projectID, $eventProjectID, $userID, $authorID, $type)
                 $evaluations = array();

                 while($r = $stmt->fetch(PDO::FETCH_ASSOC))
                 {
                   $evaluations[] = new Evaluate($r['evaluationID'], $r['criteriaID'], $r['rating'], $r['comment'], $r['projectID'], $r['eventProjectID'],$r['userID'], $r['author'], $r['type']);
                 }
                 $message = $evaluations;
               }
               else
               {
                 $message = 0;
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
