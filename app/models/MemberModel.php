<?php

class MemberModel {

	private $table = 'members';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function get() {
		
		$this->db->query("SELECT * FROM " . $this->table);
		$this->db->execute();
		return $this->db->resultSet();

	}

    public function save($data) {

    }

    public function update($data) {

    }

    public function delete($data) {
        
    }
	
}