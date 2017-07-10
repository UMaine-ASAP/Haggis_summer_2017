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

				}
				catch(PDOException $e)
				{
					echo "Error: ". $e->getMessage();
				}
    	}

    	public static function id($id){

    	}

    	public static function create($fn, $ln, $mi, $em, $pw){		//inserts user information into database
				$db = Db::getInstance();
				$sql = "INSERT INTO user (firstName,lastName,middleInitial,email,password,userType) VALUES (?,?,?,?,?,?)";

				try
				{
					$stmt = $db->prepare($sql);
					$data = array($fn, $ln, $mi, $em, $pw,"user");
					$stmt->execute($data);
					return "Successfully registered ".$fn." ".$mi.". ".$ln;
				}
				catch(PDOException $e)
				{
					return "Error: " . $e->getMessage();
				}
			}



    	public static function update(){

    	}

    	public static function delete(){

    	}
	}
?>
