<?php 
	class Admin extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->library("session");
			$this->load->helper("security");
			$this->load->model("user");
		}

		public function index() {
			$data["users"] = $this->user->get_users();
			$this->load->view("admin/home", $data);
		}

		/*DOCU This function logs out the current user and deletes all session data. Owner:Philip */
		public function logout() {
			session_destroy();
			redirect("users");
		}
	
	}
?>