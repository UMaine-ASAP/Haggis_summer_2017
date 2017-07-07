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

    	public static function all(){

    	}

    	public static function id($id){

    	}

    	public static function create(){

    	}

    	public static function update(){

    	}

    	public static function delete(){

    	}
	}
?>