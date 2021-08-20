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

		try {   

            $created_at = $updated_at = date('Y-m-d H:i:s');

            $this->db->query("INSERT INTO " . $this->table . " VALUES (:isbn, :title, :category, :writer, :publisher, :status, :cover, :year, :created_at, :updated_at)");
            $this->db->bind('isbn', $data['isbn']);
            $this->db->bind('title', $data['title']);
            $this->db->bind('category', $data['category']);
            $this->db->bind('writer', $data['writer']);
            $this->db->bind('publisher', $data['publisher']);
            $this->db->bind('status', $data['status']);
            $this->db->bind('cover', $data['cover']);
            $this->db->bind('year', $data['year']);
            $this->db->bind('created_at', $created_at);
            $this->db->bind('updated_at', $updated_at);
            $this->db->execute();

            return $this->db->rowCount();

        }
        catch(Exception $e) {
            return false;
        }

    }

    public function update($data) {

		try {
			$updated_at = date('Y-m-d H:i:s');

			if($data['cover']) {
				$this->db->query("UPDATE " . $this->table . " SET isbn = :isbn, title = :title, category = :category, writer = :writer, publisher = :publisher, status = :status, cover = :cover, year = :year, updated_at = :updated_at WHERE isbn = :isbn");
				$this->db->bind('isbn', $data['isbn']);
				$this->db->bind('title', $data['title']);
				$this->db->bind('category', $data['category']);
				$this->db->bind('writer', $data['writer']);
				$this->db->bind('publisher', $data['publisher']);
				$this->db->bind('status', $data['status']);
				$this->db->bind('cover', $data['cover']);
				$this->db->bind('year', $data['year']);
				$this->db->bind('updated_at', $updated_at);
			}
			else {
				$this->db->query("UPDATE " . $this->table . " SET isbn = :isbn, title = :title, category = :category, writer = :writer, publisher = :publisher, status = :status, year = :year, updated_at = :updated_at WHERE isbn = :isbn");
				$this->db->bind('isbn', $data['isbn']);
				$this->db->bind('title', $data['title']);
				$this->db->bind('category', $data['category']);
				$this->db->bind('writer', $data['writer']);
				$this->db->bind('publisher', $data['publisher']);
				$this->db->bind('status', $data['status']);
				$this->db->bind('year', $data['year']);
				$this->db->bind('updated_at', $updated_at);
			}

			$this->db->execute();

			return $this->db->rowCount();
		}
		catch(Exception $e) {
			return false;
		}

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