<?php 
	class Comment extends CI_Model {

		public function get_comments($id) {
			$sql = "SELECT first_name as name, comments.created_at AS comment_date, comment
					FROM comments INNER JOIN users
					ON comments.user_id = users.id
					INNER JOIN messages
					ON messages.id = comments.message_id
					WHERE comments.message_id = messages.id
					AND messages.page_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result();
		}

		public function save_comment($data) {
			$sql = "INSERT INTO comments(user_id, page_id, message_id, comment)
					VALUES (?,?,?,?)";
			return $this->db->query($sql, array($data["user_id"],$data["page_id"],$data["message_id"],$data["comment"]));
		}
	}
?>