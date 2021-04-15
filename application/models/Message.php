<?php 
	class Message extends CI_Model {

		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function get_messages($id) {
			$sql = "SELECT messages.id as id, first_name AS name, message, messages.created_at  FROM messages
					INNER JOIN users
					ON users.id = messages.user_id
					WHERE messages.page_id = ?
					ORDER BY messages.created_at DESC";
			$query = $this->db->query($sql, array($id));
			return $query->result();
		}

		public function save_message($data) {
			$sql = "INSERT INTO messages (user_id, page_id, message)
					VALUES (?,?,?)";
			return $this->db->query($sql, array($data["user_id"],$data["page_id"] ,$data["message"]));
		}
	}
?>