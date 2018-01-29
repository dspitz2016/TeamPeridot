<?php

class Account {

	private $AccountID;   // AUTO_INCREMENT
	private $FirstName;   // VARCHAR(75)
	private $LastName;    // VARCHAR(75)
	private $Email;       // VARCHAR(100)
	private $Password;    // VARCHAR(100)
	private $AccountType; // ENUM('faculty', 'student')

	public function getAccountID(){
		return $this->AccountID;
	}

	public function getFirstName(){
		return $this->FirstName;
	}

	public function getLastName(){
		return $this->LastName;
	}

	public function getEmail(){
		return $this->Email;
	}

	public function getPassword(){
		return $this->Password;
	}

	public function getAccountType(){
		return $this->AccountType;
	}
	
}