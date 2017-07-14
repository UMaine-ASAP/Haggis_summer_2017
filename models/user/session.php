<?php

class UserSession
{
  public static function login($email, $password){
    $userID ='';
    $db= Db::getInstance();
    $sql = "SELECT * FROM user WHERE email = ?";		//Pull from the database anything that matches both email and password
    $data = array($email);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result)																									//if we have a result, we pull data out
      {
        $hash = $result['password'];
        if(password_verify($password, $hash))
        {
          $emailconfirmed = $result['emailConfirmed'];
          if($emailconfirmed == '1')
          {
            $_SESSION['firstName'] = $result['firstName'];					//first name of user
            $_SESSION['lastName'] = $result['lastName'];						//last name of user
            $_SESSION['middleInitial'] = $result['middleInitial'];	//middle initial of user
            $userID = $result['userID'];									//token of user (currentl using userID)
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
              $result = '';
              for ($i = 0; $i < 20; $i++){
                  $result .= $characters[mt_rand(0, 61)];
              }
            $req = $db->prepare("UPDATE user SET token = ? WHERE userID = ?");
            $data = array($result, $userID);
            $req->execute($data);
            $_SESSION['token'] = $result;
            header('Location: index.php');													//load our page back to the index
          }
          else
          {
            return "Your email has not yet been confirmed. Please check your email for a confirmation link.<a href='?controller=user&action=sendEmailConfirmation&email=".$result['email']."'>Request a new link?</a>";
          }
        }
        else
        {
          return "Your password was incorrect";
        }
      }
      else
      {
        return "The email address you provided do not match any on record";
      }
    }
    catch(PDOException $e)
    {
      return "Error: ". $e->getMessage();
    }
  }

  public static function logout()
  {
    $db = Db::getInstance();
    $req = $db->prepare("UPDATE user SET token = '' WHERE token = ?");
    $data = array($_SESSION['token']);
    $req->execute($data);
    session_unset();													//unsets all Session variables effecitvly logging the user out of current session
  }

}
?>
