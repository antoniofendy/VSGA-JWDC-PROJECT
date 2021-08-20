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

	public function find($id) {

		$this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->single();
		
	}

    public function save($data) {

		$created_at = $updated_at = date('Y-m-d H:i:s');

		$this->db->query("INSERT INTO " . $this->table . " VALUES (:id, :name, :sex, :address, :status, :picture, :created_at, :updated_at)");
		$this->db->bind('id', $data['id']);
		$this->db->bind('name', $data['name']);
		$this->db->bind('sex', $data['sex']);
		$this->db->bind('address', $data['address']);
		$this->db->bind('status', $data['status']);
		$this->db->bind('picture', $data['picture']);
		$this->db->bind('created_at', $created_at);
		$this->db->bind('updated_at', $updated_at);
		$this->db->execute();

		return $this->db->rowCount();

    }

    public function update($data) {

		$updated_at = date('Y-m-d H:i:s');

		if($data['picture']) {
			$this->db->query("UPDATE " . $this->table . " SET name = :name, sex = :sex, status = :status, address = :address, picture = :picture , updated_at = :updated_at WHERE id = :id");
			$this->db->bind('id', $data['id']);
			$this->db->bind('name', $data['name']);
			$this->db->bind('sex', $data['sex']);
			$this->db->bind('address', $data['address']);
			$this->db->bind('status', $data['status']);
			$this->db->bind('picture', $data['picture']);
			$this->db->bind('updated_at', $updated_at);
		}
		else {
			$this->db->query("UPDATE " . $this->table . " SET name = :name, sex = :sex, status = :status, address = :address, updated_at = :updated_at WHERE id = :id");
			$this->db->bind('id', $data['id']);
			$this->db->bind('name', $data['name']);
			$this->db->bind('sex', $data['sex']);
			$this->db->bind('address', $data['address']);
			$this->db->bind('status', $data['status']);
			$this->db->bind('updated_at', $updated_at);
		}

		$this->db->execute();

		return $this->db->rowCount();

    }

    public function delete($id) {

		try {
			$this->db->query("DELETE FROM " . $this->table . " WHERE id = :id");
			$this->db->bind('id', $id);
			$this->db->execute();

			return $this->db->rowCount();
		}
		// Exception Needed Because Members ID is a Foreign Key on another table
		catch(Exception $e) {
			return false;
		}


    }
	
}