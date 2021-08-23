<?php

class UserModel {

	private $table = 'users';
	private $db;

	public function __construct() {

		$this->db = new Database;

	}

	public function get() {
		
		$this->db->query("SELECT u.id, u.members_id, m.name FROM " . $this->table . " u INNER JOIN members m ON u.members_id = m.id");
		$this->db->execute();
		$result = $this->db->resultSet();

		$this->db->close();
		return $result;

	}

	public function getAllUsername() {

		$this->db->query("SELECT username FROM " . $this->table);
		$this->db->execute();
		$result = $this->db->resultSet();

		$this->db->close();
		return $result;

	}

	public function find($id) {

		$this->db->query("SELECT u.id, u.members_id, m.name, u.username, u.password FROM " . $this->table . " u INNER JOIN members m ON u.members_id = m.id WHERE u.id = :id");
		$this->db->bind('id', $id);
		$this->db->execute();
		$result = $this->db->single();

		$this->db->close();
		return $result;

	}

	public function findAccount($data) {

		$this->db->query("SELECT * FROM " . $this->table . " u WHERE username = :username and password = :password");
		$this->db->bind('username', $data['username']);
		$this->db->bind('password', $data['password']);
		$this->db->execute();
		$result = $this->db->single();

		$this->db->close();
		return $result;

	}

    public function save($data) {

		try {   

            $created_at = $updated_at = date('Y-m-d H:i:s');

            $this->db->query("INSERT INTO " . $this->table . " VALUES (:id, :members_id, :username, :password, :created_at, :updated_at)");
            $this->db->bind('id', $data['user_id']);
            $this->db->bind('members_id', $data['id']);
            $this->db->bind('username', $data['id']);
            $this->db->bind('password', md5(date('ymd')));
            $this->db->bind('created_at', $created_at);
            $this->db->bind('updated_at', $updated_at);
            $this->db->execute();

            $result = $this->db->rowCount();

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

            $this->db->query("UPDATE " . $this->table . " SET username = :username, password = :password, updated_at = :updated_at WHERE id = :id");
            $this->db->bind('id', $data['id']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', $data['password']);
            $this->db->bind('updated_at', $updated_at);
	
			$this->db->execute();

			$result = $this->db->rowCount();

			$this->db->close();
			return $result;
		}
		catch(Exception $e) {
			return false;
		}

    }

	public function delete($id) {

		try {
			$this->db->query("DELETE FROM " . $this->table . " WHERE members_id = :id");
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