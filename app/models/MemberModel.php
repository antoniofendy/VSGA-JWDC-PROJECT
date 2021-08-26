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

		$result = $this->db->resultSet();

		$this->db->close();
		return $result;

	}

	public function getTransactionable() {
		
		$this->db->query("SELECT id, name FROM " . $this->table . " WHERE status = :status");
		$this->db->bind('status', 'not_borrowing');
		$this->db->execute();

		$result = $this->db->resultSet();

		$this->db->close();
		return $result;

	}

	public function find($id) {

		$this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
		$this->db->bind('id', $id);
		$this->db->execute();
		$result = $this->db->single();
		
		$this->db->close();
		return $result;

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

		$result = $this->db->rowCount();

		$this->db->close();
		return $result;

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

		$result = $this->db->rowCount();

		$this->db->close();
		return $result;

    }

	public function updateStatus($id, $status) {

		$updated_at = date('Y-m-d H:i:s');
		
		$this->db->query("UPDATE " . $this->table . " SET status = :status, updated_at = :updated_at WHERE id = :id");
		$this->db->bind('status', $status);
		$this->db->bind('updated_at', $updated_at);
		$this->db->bind('id', $id);

		$this->db->execute();

		$result = $this->db->rowCount();

		$this->db->close();
		return $result;

	}

    public function delete($id) {

		try {
			$this->db->query("DELETE FROM " . $this->table . " WHERE id = :id");
			$this->db->bind('id', $id);
			$this->db->execute();

			$result = $this->db->rowCount();
			
			$this->db->close();
			return $result;
		}
		// Exception Needed Because Members ID is a Foreign Key on another table
		catch(Exception $e) {
			return false;
		}

    }
	
}