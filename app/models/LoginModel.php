<?php

class LoginModel {

	private $table = 'admins';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function find($data) {
		
		$this->db->query("SELECT * FROM " . $this->table . " WHERE username = :username and password = :password");
		$this->db->bind('username', $data['username']);
		$this->db->bind('password', $data['password']);
		$this->db->execute();
		
		$result =  $this->db->single();

		$this->db->close();
		return $result;

	}
	
}