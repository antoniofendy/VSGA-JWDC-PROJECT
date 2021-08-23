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
		$result = $this->db->resultSet();
		$this->db->close();
		return $result;

	}

	public function find($isbn) {

		$this->db->query("SELECT * FROM " . $this->table . " WHERE isbn = :isbn");
		$this->db->bind('isbn', $isbn);
		$this->db->execute();
		$result = $this->db->single();
		$this->db->close();
		return $result;

	}

	public function search($keyword, $page) {

		$limit = 5;

		$offset = (intval($page)-1) * $limit;

		$this->db->query("SELECT * FROM " . $this->table . " WHERE 
			title LIKE :keyword OR
			isbn LIKE :keyword OR
			category LIKE :keyword OR
			writer LIKE :keyword OR
			publisher LIKE :keyword OR
			year LIKE :keyword LIMIT :offset, :limit
		");
		$this->db->bind('keyword', "%$keyword%");
		$this->db->bind('offset', $offset);
		$this->db->bind('limit', $limit);
		$this->db->execute();
		$result = $this->db->resultSet();
		$this->db->close();
		return $result;

	}

	public function allRecord($keyword) {

		$limit = 5;

		$this->db->query("SELECT * FROM " . $this->table . " WHERE 
			title LIKE :keyword OR
			isbn LIKE :keyword OR
			category LIKE :keyword OR
			writer LIKE :keyword OR
			publisher LIKE :keyword OR
			year LIKE :keyword 
		");
		$this->db->bind('keyword', "%$keyword%");
		$this->db->execute();
		$result = $this->db->resultSet();
		$this->db->close();

		$result = count($result);

		$total_record = ceil($result/$limit);

		return $total_record;

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

            $result =  $this->db->rowCount();

			$this->db->close();
			return $result;

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

			$result = $this->db->rowCount();
			
			$this->db->close();
			return $result;
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

			$result = $this->db->rowCount();
			
			$this->db->close();
			return $result;
		}
		// Exception Needed to Prevent If This Primary Key is a Foreign Key on Another Table
		catch(Exception $e) {
			return false;
		}


    }
	
}