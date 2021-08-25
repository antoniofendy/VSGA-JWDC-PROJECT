<?php

class TransactionModel {

	private $table = 'transactions';
	private $db;

	public function __construct() {

		$this->db = new Database;

	}

    public function get() {
		
		$this->db->query("SELECT t.trans_id, t.members_id, m.name, t.books_isbn, b.title, t.borrow_date, t.due_date, t.return_date FROM " . $this->table . " t INNER JOIN members m ON t.members_id = m.id INNER JOIN books b ON t.books_isbn = b.isbn");
		$this->db->execute();
		$result = $this->db->resultSet();

		$this->db->close();
		return $result;

    }

	public function getAllTransaction() {
		
		$this->db->query("SELECT * FROM " . $this->table);
		$this->db->execute();
		$result = $this->db->resultSet();

		$this->db->close();
		return $result;

	}

	public function find($id) {



	}

    public function save($data) {

		

    }

    public function update($data) {

		

    }

	public function delete($id) {

		

    }
	
}