<?php
	Class User {
		public $id;
		public $firstName;
		public $lastName;
		public $email;

		public function __construct($id, $firstName, $lastName, $email) {
      		$this->id = $id;
      		$this->firstName = $firstName;
      		$this->lastName = $lastName;
      		$this->email = $email;
    	}


    	public static function all(){																//collects user ID's from Database
				$db = Db::getInstance();
				$sql = "SELECT * FROM user";
				$userList = array();
				try
				{
					$stmt = $db->prepare($sql);
					$stmt->execute();
					while($result = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$userList[] = new User($result['userID'], $result['firstName'], $result['lastName'], $result['email']);
					}
					return $userList;

				}
				catch(PDOException $e)
				{
					echo "Error: ". $e->getMessage();
				}
    	}

    	public static function id($id){

    	}

    	public static function resetPassword($code, $password){
    		$db = Db::getInstance();
			$req = $db->prepare("UPDATE user SET password = '$password', resetCode = '' WHERE resetCode = '$code'");
			$req->execute();
    	}

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

    	public static function create($fn, $ln, $mi, $em, $pw){		//inserts user information into database
				$currentUsers = User::all();
				$conflict = false;
				foreach($currentUsers as $user)
				{
					if($user->email == $em)
					$conflict = true;
				}

				if($conflict)
					return "The email '".$em."' is already registered. <a href='?controller=user&action=passwordResetRequest'>Forgot Password?</a> or <a href='?controller=user&action=passwordResetRequest'>Sign-in</a>";
				else
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

		public static function login($email, $password){

			$db= Db::getInstance();
			$sql = "SELECT * FROM user WHERE password = ? AND email = ?";
			$data = array($password, $email);
			try
			{
				$stmt = $db->prepare($sql);
				$stmt->execute($data);
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				if($result)
				{
					$_SESSION['firstName'] = $result['firstName'];
					$_SESSION['lastName'] = $result['lastName'];
					$_SESSION['middleInitial'] = $result['middleInitial'];
					$_SESSION['token'] = $result['userID'];
					header('Location: index.php');
				}
				else
					echo "The user credentials you provided do not match any on record";
				}
				catch(PDOException $e)
				{
					echo "Error: ". $e->getMessage();
				}

			// echo "DOING STUFF";

		}

		public static function logout()
		{
			session_unset();
		}



    	public static function update(){

    	}

    	public static function delete(){

    	}
	}
?>
