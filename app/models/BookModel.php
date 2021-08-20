<?php

class BookModel {

	private $table = 'books';
	private $db;

	public function __construct() {

		$this->db = new Database;

	}

	public function get() {
		
		$this->db->query("SELECT * FROM " . $this->table);
		$this->db->execute();
		return $this->db->resultSet();

	}

	public function find($isbn) {

		$this->db->query("SELECT * FROM " . $this->table . " WHERE isbn = :isbn");
		$this->db->bind('isbn', $isbn);
		$this->db->execute();
		return $this->db->single();
        
	}

    public function save($data) {

		$created_at = $updated_at = date('Y-m-d H:i:s');

		$this->db->query("INSERT INTO " . $this->table . " VALUES (, :created_at, :updated_at)");

		$this->db->bind('created_at', $created_at);
		$this->db->bind('updated_at', $updated_at);
		$this->db->execute();

		return $this->db->rowCount();

    }

    public function update($data) {

		$updated_at = date('Y-m-d H:i:s');

		if($data['picture']) {
			$this->db->query("UPDATE " . $this->table . " SET ");
			$this->db->bind('updated_at', $updated_at);
		}
		else {
			$this->db->query("UPDATE " . $this->table . " SET ");
			$this->db->bind('updated_at', $updated_at);
		}

		$this->db->execute();

		return $this->db->rowCount();

    }

    public function delete($isbn) {

		try {
			$this->db->query("DELETE FROM " . $this->table . " WHERE isbn = :isbn");
			$this->db->bind('isbn', $isbn);
			$this->db->execute();

			return $this->db->rowCount();
		}
		// Exception Needed to Prevent If This Primary Key is a Foreign Key on Another Table
		catch(Exception $e) {
			return false;
		}


    }
	
}