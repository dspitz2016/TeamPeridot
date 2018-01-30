<?php

class Account {

	private $idAccount;
	private $firstName;
	private $lastName;
	private $email;
	private $password;

	public function getAccountID(){
		return $this->idAccount;
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function getLastName(){
		return $this->lastName;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPassword(){
		return $this->password;
	}

}
