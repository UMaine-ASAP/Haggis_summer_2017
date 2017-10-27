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
}
// //=================================================================================== ALL
//   public static function all()
//   {
//     $errorCode;
//     $message;
//     $db = Db::getInstance();
//     $sql = "SELECT * FROM criteria GROUP BY title";
//     $stmt = $db->prepare($sql);
//     try
//     {
//         $stmt->execute();
//         $criteriaArray = array();
//         while($r = $stmt->fetch(PDO::FETCH_ASSOC))
//         {
//           $criteriaArray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);
//         }
//         $message = $criteriaArray;
//         $errorCode= 1;
//     }
//     catch(PDOException $e)
//     {
//       $errorCode = $e->getCode();
//       $message = $e->getMessage();
//     }
//     return array($errorCode, $message);
//   }
// //=================================================================================== CREATE CRITERIA SET
//   public static function createSet($setName, $setDescription)
//   {
//     {
//       $errorCode;
//       $message;
//       $db = Db::getInstance();
//       $sql = "INSERT INTO criteriaset (title, description) VALUES (?,?)";
//       $stmt = $db->prepare($sql);
//       $data = array($setName, $setDescription);
//       try
//       {
//           $stmt->execute($data);
//           $message = $db->lastInsertId();
//           $errorCode= 1;
//       }
//       catch(PDOException $e)
//       {
//         $errorCode = $e->getCode();
//         $message = $e->getMessage();
//       }
//       return array($errorCode, $message);
//     }
//   }
// //=================================================================================== ADD CRITERIA TO A SET
//   public static function addToSet($setID, $criteriaID)
//   {
//     {
//       $errorCode;
//       $message;
//       $db = Db::getInstance();
//       $sql = "INSERT INTO criteriaset (criteriaID, criteriaSetID) VALUES (?,?)";
//       $stmt = $db->prepare($sql);
//       $data = array($setID, $criteriaID);
//       try
//       {
//           $stmt->execute($data);
//           $message = "CriteriaAddedToSet";
//           $errorCode= 1;
//       }
//       catch(PDOException $e)
//       {
//         $errorCode = $e->getCode();
//         $message = $e->getMessage();
//       }
//       return array($errorCode, $message);
//     }
//   }
//   //=================================================================================== Linke Criteria to Assignment
//     public static function associateWithAssignment($assignmentID, $criteriaID)
//     {
//       {
//         $errorCode;
//         $message;
//         $db = Db::getInstance();
//         $sql = "INSERT INTO assignment_criteria (assignmentID, criteriaID) VALUES (?,?)";
//         $stmt = $db->prepare($sql);
//         $data = array($assignmentID, $criteriaID);
//         try
//         {
//             $stmt->execute($data);
//             $message = "CriteriaAddedToAssignment";
//             $errorCode= 1;
//         }
//         catch(PDOException $e)
//         {
//           $errorCode = $e->getCode();
//           $message = $e->getMessage();
//         }
//         return array($errorCode, $message);
//       }
//     }
//   //=================================================================================== Link Set to User
//
//     public static function associateWithUser($userID, $setID)
//     {
//       {
//         $errorCode;
//         $message;
//         $db = Db::getInstance();
//         $sql = "INSERT INTO user_criteriaset (userID, criteriaSetID) VALUES (?,?)";
//         $stmt = $db->prepare($sql);
//         $data = array($userID, $setID);
//         try
//         {
//             $stmt->execute($data);
//             $message = "CriteriaSetAssociatedWithUser";
//             $errorCode= 1;
//         }
//         catch(PDOException $e)
//         {
//           $errorCode = $e->getCode();
//           $message = $e->getMessage();
//         }
//         return array($errorCode, $message);
//       }
//     }
//   //=================================================================================== GET CRITERIA BY ASSIGNMENT
//     public static function assignmentID($assignmentID)
//     {
//         $errorCode;
//         $message;
//         $db = Db::getInstance();
//         $sql = "SELECT * FROM criteria WHERE criteriaID IN (SELECT criteriaID FROM assignment_criteria WHERE assignment_criteria.assignmentID = ?)";
//         $data = array($assignmentID);
//         try
//         {
//           $stmt = $db->prepare($sql);
//           $stmt->execute($data);
//           $criteriaarray = array();
//           while($r = $stmt->fetch(PDO::FETCH_ASSOC))
//           {
//             $criteriaarray[] = new Criteria($r['criteriaID'], $r['title'], $r['description'], $r['rateRangeMin'], $r['rateRangeMax'], $r['allowTextResponse']);
//           }
//           $message = $criteriaarray;
//           $errorCode = 1;
//         }
//         catch(PDOException $e)
//         {
//           $errorCode = $e->getCode();
//           $message = $e->getMessage();
//         }
//         return array($errorCode, $message);
//     }
//     //=================================================================================== DELETE CRITERIA ASSIGNMENT
//       public static function deleteAssociation($assignmentID)
//       {
//           $errorCode;
//           $message;
//           $db = Db::getInstance();
//           $sql = "DELETE FROM assignment_criteria WHERE assignmentID = ?";
//           $data = array($assignmentID);
//           try
//           {
//             $stmt = $db->prepare($sql);
//             $stmt->execute($data);
//             $message = "criteria associations have beend deleted.";
//             $errorCode = 1;
//           }
//           catch(PDOException $e)
//           {
//             $errorCode = $e->getCode();
//             $message = "CRITERIA DISASSOCIATION ".$e->getMessage();
//           }
//           return array($errorCode, $message);
//       }
// }
