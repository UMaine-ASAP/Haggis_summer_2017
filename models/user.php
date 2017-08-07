<?php
Class User {
  public $id;
  public $firstName;
  public $lastName;
  public $email;
//=================================================================================== STRUCT
  public function __construct($id, $firstName, $middleInitial, $lastName, $email, $usertype) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->middleInitial = $middleInitial;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->usertype = $usertype;
    }
//=================================================================================== CHECK ADMIN
    public static function checkAdmin($token)
    {
      $db = Db::getInstance();
      $sql = "SELECT userType FROM user WHERE token = ?";
      $data = array($token);
      $stmt = $db->prepare($sql);
      $stmt ->execute($data);
      $output = false;

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result['userType'] == "admin")
      {
        $output = true;
      }
      return array(1, $output);
    }
//=================================================================================== CREATE
    public static function create($fn, $ln, $mi, $em, $pw){		//inserts user information into database
      $errorCode;
      $message;
      $currentUsers = User::all()[1];					//Get a list of users
      $conflict = false;										//becomes true if email and password already exist
      foreach($currentUsers as $user)				//goes through the user list and checks to see if email already exists
      {
        if($user->email == $em)
        $conflict = true;
      }
      if($conflict)													//if email already exists, tell the user.
      {
        $errorCode = 2;
        $message   = "Email address is already registered";
      }

      else 																	//else, we insert our new user into the database
      {
        $salted = password_hash($pw, PASSWORD_DEFAULT);
        $db = Db::getInstance();
        $sql = "INSERT INTO user (firstName,lastName,middleInitial,email,password,userType) VALUES (?,?,?,?,?,?)";
        try
        {
          $stmt = $db->prepare($sql);
          $data = array($fn, $ln, $mi, $em, $salted,"user");
          $stmt->execute($data);
          User::sendConfirmEmail($em);
          $errorCode = 1;
          $message = "Account Created, Check your email for a confirmation link prior to logging in.";
        }
        catch(PDOException $e)
        {
          $errorCode  = $e->getCode();
          $message    = $e->getMessage();
        }
      }
      return array($errorCode, $message);
    }
//=================================================================================== DELETE
    public static function delete($id)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "DELETE FROM user WHERE userID = ?";
      $data = array($id);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $errorCode = 1;
        $message = "User Deleted";
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== CONFIRM EMAIL
    public static function confirmEmail($code)
    {
      $db = Db::getInstance();
      $req = $db->prepare("UPDATE user SET emailConfirmed = '1', emailConfirmedCode ='' WHERE emailConfirmedCode = '$code'");
      $req->execute();
      return array(1, "Email Confirmed");

    }
//=================================================================================== SEND CONFIRM EMAIL
    public static function sendConfirmEmail($email)
    {
      $db = Db::getInstance();
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $result = '';
      for ($i = 0; $i < 19; $i++){
          $result .= $characters[mt_rand(0, 61)];
      }
      $req = $db->prepare("UPDATE user SET emailConfirmedCode = ? WHERE email = ?");
      $data = array($result, $email);
      $req->execute($data);

      $to = $email;
      $subject = 'Haggis Email confirmation';
      $message = 'You registered for an account. Click the link below to confirm your email address  ' .
      "chitna.asap.um.maine.edu/Haggis_summer_2017/?controller=user&action=emailConfirmation&code=$result" .
      "  If you didn't register for an account ignore this email";
      $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
      mail($to, $subject, $message, $headers);
      return array(1, "Email confirmation email sent");
    }
//=================================================================================== RESET PASSWORD
    public static function resetPassword($code, $password)
    {
      $db = Db::getInstance();
      $salted = password_hash($password, PASSWORD_DEFAULT);
      $req = $db->prepare("UPDATE user SET password = ?, resetCode = '' WHERE resetCode = ?");
      $data = array($salted, $code);
      $req->execute($data);
      return array(1, "Password has been reset");
    }
//=================================================================================== SEND RESET PASSWORD EMAIL
    public static function sendResetEmail($email){
      $db = Db::getInstance();

    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      $result = '';
      for ($i = 0; $i < 19; $i++){
          $result .= $characters[mt_rand(0, 61)];
      }
    $req = $db->prepare("UPDATE user SET resetCode = '$result' WHERE email = '$email'");
    $req->execute();

    $to = $email;
    $subject = 'Haggis Password Reset';
    $message = 'You requested a password reset. If you requested a password reset click the link below.  ' .
    "chitna.asap.um.maine.edu/Haggis_summer_2017/?controller=user&action=passwordReset&code=$result" .
    "  If you didn't request a password reset ignore this email";
    $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
    mail($to, $subject, $message, $headers);
    return array(1, "Password Reset Email Sent");
    }
//=================================================================================== ALL USERS
    public static function all(){					//collects user ID's from Database
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM user";
      $userList = array();								//used to store User objects
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
        {
          $userList[] = new User($result['userID'], $result['firstName'], $result['middleInitial'], $result['lastName'], $result['email'], $result['userType']);	//and adds a user object with information aquired
        }
        $errorCode = 1;
        $message = $userList;			//returns array of User Objects

      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== USERS BY ID
    public static function id($id){
      $errorCode;
      $message;
      $db= Db::getInstance();
      $sql = "SELECT * FROM user WHERE userID = ?";
      $data = array($id);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result)																									//if we have a result, we pull data out
        {
          $errorCode = 1;
          $message =  new User($result['userID'], $result['firstName'],$result['middleInitial'], $result['lastName'], $result['email'], $result['userType']);	//and adds a user object with information aquired
        }
        else
        {
          $errorCode = 3;
          $message = "User not found";
        }
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== LOGIN
    public static function login($email, $password){
      $errorCode;
      $message;
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
            if($result['emailConfirmed'] == '1')
            {
              $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
              $token = '';
              for ($i = 0; $i < 20; $i++)
                $token .= $characters[mt_rand(0, 61)];
              User::insertToken($result['userID'], $token);
              $errorCode = 1;
              $message = array($result['firstName'],$result['lastName'],$result['middleInitial'],$token, $result['userID']);
            }
            else
            {
              $errorCode = 4;
              $message = "Your email has not yet been confirmed. Please check your email for a confirmation link.";
            }
          }
          else
          {
            $errorCode = 5;
            $message = "Your email and/or password were incorrect. Please try again.";
          }
        }
        else
        {
          $errorCode = 5;
          $message =  "Your email and/or password were incorrect. Please try again.";
        }
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== INSERT TOKEN
  function insertToken($userID, $token)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    try
    {
      $stmt = $db->prepare("UPDATE user SET token = ? WHERE userID = ?");
      $data = array($token, $userID);
      $stmt->execute($data);
      $errorCode = 1;
      $message = "Token Update Successful";
    }
    catch(PDOException $e)
    {
      $errorCode =  $e->getCode();
      $message =    $e->getMessage();
    }
    return array($errorCode, $message);
  }
//=================================================================================== LOGOUT
    public static function logout($token)
    {
      $db = Db::getInstance();
      $req = $db->prepare("UPDATE user SET token = '' WHERE token = ?");
      $data = array($token);
      $req->execute($data);
      return array(1, "Successful Logoff");
    }
//=================================================================================== UPDATE USER
    public static function update($fn, $ln, $mi, $em, $ut, $ui){
      $errorCode;
      $message;
      $db= Db::getInstance();
      $data = array($fn, $ln, $mi, $em, $ut, $ui);
      $sql = "UPDATE user SET firstName = ?, lastName = ?, middleInitial = ?, email = ?, userType = ? WHERE userID = ?";
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $errorCode = 1;
        $message = "User succesfully updated";
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== GET USER ID
  public static function getID($token)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $data= array($token);
    $sql = "SELECT userID FROM user WHERE token = ?";
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $errorCode = 1;
      $message = $stmt->fetch()['userID'];
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
  }
  }
?>
