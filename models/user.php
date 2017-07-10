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


    	public static function all(){															//collects user ID's from Database
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

    	public function resetPassword($code, $password){
    		$db = Db::getInstance();
			$sql = "SELECT * FROM user WHERE resetCode = $code";
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
			$message = 'You requested a password reset. If you requested a password reset click the link below.\n' . 
			"chitna.asap.um.maine.edu/Haggis_summer_2017/?controller=user&action=passwordReset&id='$result'" .
			"  If you didn't request a password reset ignore this email";
			$headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
			mail($to, $subject, $message, $headers);

    	}

    	public static function create($fn, $ln, $mi, $em, $pw){		//inserts user information into database
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



    	public static function update(){

    	}

    	public static function delete(){

    	}
	}
?>
