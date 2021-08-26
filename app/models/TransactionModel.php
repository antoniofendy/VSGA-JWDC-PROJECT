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

	public function getReturnAble() {
		
		$this->db->query("SELECT t.trans_id, t.members_id, m.name, t.books_isbn, b.title, t.borrow_date, t.due_date, t.return_date, t.extend_count FROM " . $this->table . " t INNER JOIN members m ON t.members_id = m.id INNER JOIN books b ON t.books_isbn = b.isbn WHERE return_date = 0000-00-00");
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

	public function find($trans_id) {

		$this->db->query("SELECT * FROM " . $this->table . " WHERE trans_id = :trans_id");
		$this->db->bind('trans_id', $trans_id);
		$this->db->execute();
		$result = $this->db->single();

		$this->db->close();
		return $result;

	}

	public function findJoinedTable($trans_id) {

		$this->db->query("SELECT t.trans_id, t.members_id, m.name, t.books_isbn, b.title, t.borrow_date, t.due_date, t.return_date FROM " . $this->table . " t INNER JOIN members m ON t.members_id = m.id INNER JOIN books b ON t.books_isbn = b.isbn WHERE t.trans_id = :trans_id");
		$this->db->bind('trans_id', $trans_id);
		$this->db->execute();
		$result = $this->db->single();

		$this->db->close();
		return $result;

	}

    public function save($data) {

		$created_at = $updated_at = date('Y-m-d H:i:s');

		$this->db->query("INSERT INTO " . $this->table . " VALUES (:trans_id, :members_id, :book_isbn, :borrow_date, :due_date, :return_date, :extend_count, :created_at, :updated_at)");
		$this->db->bind('trans_id', $data['trans_id']);
		$this->db->bind('members_id', $data['member']);
		$this->db->bind('book_isbn', $data['book']);
		$this->db->bind('borrow_date', $data['borrow']);
		$this->db->bind('due_date', $data['due']);
		$this->db->bind('return_date', "");
		$this->db->bind('extend_count', 0);
		$this->db->bind('created_at', $created_at);
		$this->db->bind('updated_at', $updated_at);
		$this->db->execute();

		$result = $this->db->rowCount();

		$this->db->close();
		return $result;

    }

    public function extend_transaction($data) {

		$updated_at = date('Y-m-d H:i:s');

		$this->db->query("UPDATE  " . $this->table . " SET due_date = :due_date, extend_count = :extend_count, updated_at = :updated_at WHERE trans_id = :trans_id");
		$this->db->bind('due_date', $data['due_date']);
		$this->db->bind('extend_count', 1);
		$this->db->bind('updated_at', $updated_at);
		$this->db->bind('trans_id', $data['trans_id']);
		$this->db->execute();

		$result = $this->db->rowCount();

		$this->db->close();
		return $result;

    }

	public function return_transaction($data) {

		$updated_at = date('Y-m-d H:i:s');

		$this->db->query("UPDATE  " . $this->table . " SET return_date = :return_date, updated_at = :updated_at WHERE trans_id = :trans_id");
		$this->db->bind('return_date', $data['return_date']);
		$this->db->bind('updated_at', $updated_at);
		$this->db->bind('trans_id', $data['trans_id']);
		$this->db->execute();

		$result = $this->db->rowCount();

		$this->db->close();
		return $result;

	}

	public function delete($trans_id) {

		try {
			$this->db->query("DELETE FROM " . $this->table . " WHERE trans_id = :trans_id");
			$this->db->bind('trans_id', $trans_id);
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