<?php
class UserCreation
{
  public static function create($fn, $ln, $mi, $em, $pw){		//inserts user information into database
    $currentUsers = UserPull::all();					//Get a list of users
    $conflict = false;										//becomes true if email and password already exist
    foreach($currentUsers as $user)				//goes through the user list and checks to see if email already exists
    {
      if($user->email == $em)
      $conflict = true;
    }
    if($conflict)													//if email already exists, tell the user.
      return '2';
    else 																	//else, we insert our new user into the database
    {
      $salted = password_hash($pw, PASSWORD_DEFAULT);
      $db = Db::getInstance();
      $sql = "INSERT INTO user (firstName,lastName,middleInitial,email,password,userType) VALUES (?,?,?,?,?,?)";
      try{
        $stmt = $db->prepare($sql);
        $data = array($fn, $ln, $mi, $em, $salted,"user");
        $stmt->execute($data);
        UserEmail::sendConfirmEmail($em);
        return '1';
      }catch(PDOException $e) {
        return "Error: " . $e->getMessage();
      }
    }
}
}
?>
