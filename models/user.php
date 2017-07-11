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

//=================================================================================== ALL
    	public static function all(){					//collects user ID's from Database
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
					return $userList;			//returns array of User Objects

				}
				catch(PDOException $e)
				{
					echo "Error: ". $e->getMessage();
				}
    	}

//=================================================================================== RESET PASSWORD
    	public static function resetPassword($code, $password){
    		$db = Db::getInstance();
			$req = $db->prepare("UPDATE user SET password = '$password', resetCode = '' WHERE resetCode = '$code'");
			$req->execute();
    	}
//=================================================================================== SEND RESET EMAIL
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

    	}
//=================================================================================== CREATE
    	public static function create($fn, $ln, $mi, $em, $pw){		//inserts user information into database
				$currentUsers = User::all();					//Get a list of users
				$conflict = false;										//becomes true if email and password already exist
				foreach($currentUsers as $user)				//goes through the user list and checks to see if email already exists
				{
					if($user->email == $em)
					$conflict = true;
				}
				if($conflict)													//if email already exists, tell the user.
					return "The email '".$em."' is already registered. <a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a> or <a href='?controller=user&action=passwordResetRequest'>Sign-in</a>";
				else 																	//else, we insert our new user into the database
				{
					$db = Db::getInstance();
					$sql = "INSERT INTO user (firstName,lastName,middleInitial,email,password,userType) VALUES (?,?,?,?,?,?)";
					try{
						$stmt = $db->prepare($sql);
						$data = array($fn, $ln, $mi, $em, $pw,"user");
						$stmt->execute($data);
						return "Successfully registered ".$fn." ".$mi.". ".$ln;
					}catch(PDOException $e) {
						return "Error: " . $e->getMessage();
					}
				}
		}
//=================================================================================== LOGIN
		public static function login($email, $password){

			$db= Db::getInstance();
			$sql = "SELECT * FROM user WHERE password = ? AND email = ?";		//Pull from the database anything that matches both email and password
			$data = array($password, $email);
			try
			{
				$stmt = $db->prepare($sql);
				$stmt->execute($data);
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				if($result)																									//if we have a result, we pull data out
				{
					$_SESSION['firstName'] = $result['firstName'];					//first name of user
					$_SESSION['lastName'] = $result['lastName'];						//last name of user
					$_SESSION['middleInitial'] = $result['middleInitial'];	//middle initial of user
					$_SESSION['token'] = $result['userID'];									//token of user (currentl using userID)
					header('Location: index.php');													//load our page back to the index
				}
				else
					echo "The user credentials you provided do not match any on record";
				}
				catch(PDOException $e)
				{
					echo "Error: ". $e->getMessage();
				}
		}
//=================================================================================== LOGOUT
		public static function logout()
		{
			session_unset();													//unsets all Session variables effecitvly logging the user out of current session
		}
//=================================================================================== CHECK ADMIN
		public static function checkAdmin($token)
		{
			$db = Db::getInstance();
			$sql = "SELECT userType FROM user WHERE userID = ?";
			$data = array($token);
			$stmt = $db->prepare($sql);
			$stmt ->execute($data);
			$output = false;

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if($result['userType'] == "admin")
			{
				$output = true;
			}
			return $output;
		}

//=================================================================================== ID
		    	public static function id($id){
						$db= Db::getInstance();
						$sql = "SELECT * FROM user WHERE userID = ?";		//Pull from the database anything that matches both email and password
						$data = array($id);
						try
						{
							$stmt = $db->prepare($sql);
							$stmt->execute($data);
							$result = $stmt->fetch(PDO::FETCH_ASSOC);
							if($result)																									//if we have a result, we pull data out
							{
								return new User($result['userID'], $result['firstName'],$result['middleInitial'], $result['lastName'], $result['email'], $result['userType']);	//and adds a user object with information aquired
							}
						}
							catch(PDOException $e)
							{
								echo "Error: ". $e->getMessage();
							}

		    	}
//=================================================================================== UPDATE
    	public static function update($input){
				$db= Db::getInstance();
				$sql = "UPDATE user SET firstName = ?, lastName = ?, middleInitial = ?, email = ?, userType = ? WHERE userID = ?";
				try
				{
					$stmt = $db->prepare($sql);
					$stmt->execute($input);
				}
				catch(PDOException $e)
				{
					echo "Error: ". $e->getMessage();
				}


    	}
//=================================================================================== DELETE
    	public static function delete(){

    	}
	}
?>
