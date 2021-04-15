<?php 
	class User extends CI_Model {
		
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		/*DOCU This function retrieves all users
		Owner:Philip */
		public function get_users() {
			$sql = "SELECT * FROM users";
			$query = $this->db->query($sql);
			return $query->result();
		}

		/*DOCU This function retrieves a user with the given email
		Owner:Philip */
		public function get_user_by_email($email) {
			$sql = "SELECT * FROM users WHERE email = ?";
			$query = $this->db->query($sql, array($email));
			return $query->result();
		}

		/*DOCU This function retrieves a user by id
		Owner:Philip */
		public function get_user_by_id($id) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result();
		}

		/*DOCU This function saves the user to the database
		Owner:Philip */
		public function save_user($data) {
			$sql = "INSERT INTO users (first_name, last_name, email, user_level, password)
					VALUES (?,?,?,?,?)";
			return $this->db->query($sql, array($data["first_name"],$data["last_name"], $data["email"], $data["user_level"], $data["password"]));
		}

		/*DOCU This function updates the user info and saves it to the database
		Owner:Philip */
		public function update_user($data) {
			$sql = "UPDATE users SET email = ?, first_name = ?, last_name = ?, user_level = ?
					WHERE users.id = ?";
			return $this->db->query($sql, array($data["email"], $data["first_name"],$data["last_name"], $data["user_level"], $data["id"]));
		}

		/*DOCU This function changes the user password and saves it to the database
		Owner:Philip */
		public function update_password($data) {
			$sql = "UPDATE users SET password = ? WHERE users.id = ?";
			return $this->db->query($sql, array($data["password"], $data["id"]));
		}

		/*DOCU This function saves user description on the database
		Owner:Philip */
		public function save_description($data) {
			$sql = "UPDATE users SET description = ? WHERE users.id = ?";
			return $this->db->query($sql, array($data["description"], $data["id"]));
		}

		/*DOCU This function deletes a user from the database
		Owner:Philip */
		public function delete($id) {
			$sql = "DELETE FROM users WHERE users.id = ?";
			return $this->db->query($sql, array($id));
		}
	}
?>