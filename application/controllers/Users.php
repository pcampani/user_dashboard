<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper("url");
		$this->load->library("session");
		$this->load->model("user");
		$this->load->model("message");
		$this->load->model("comment");
		$this->load->library('form_validation');
		$this->load->helper("security");
	}

	public function index() {
		$this->load->view('home');
	}

	/*DOCU Function to call the registration view. Owner:Philip */
	public function register() {
		$this->load->view("register");
	}

	/*DOCU Function to call the signin form view. Owner:Philip */
	public function signin() {
		$this->load->view("signin");
	}

	/*DOCU Function to call the user profile view. Owner:Philip */
	public function show($id) {
		$data["users"] = $this->user->get_user_by_id($id);
		$data["messages"] = $this->message->get_messages($id);
		$data["comments"] = $this->comment->get_comments($id);
		$this->load->view("users/show", $data);
	}

	/*DOCU This function loads the user dashboard view. Owner:Philip */
	public function user_dashboard() {
		$data["users"] = $this->user->get_users();
		$this->load->view("users/dashboard", $data);
	}

	/*DOCU This function is triggered when the user fills up the registration form 
	Checks if the entered fields are valid, alerts the user for any error on the form
	Owner:Philip */
	public function process_registration() {
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("first_name", "First name", "required|min_length[3]");
		$this->form_validation->set_rules("last_name", "Last name", "required|min_length[2]");
		$this->form_validation->set_rules("password", "Password", "required|min_length[6]|matches[confirm]");
		$this->form_validation->set_rules("confirm", "Confirm password", "required|matches[password]");

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("email_taken", "");
            $this->load->view('register');
        }
        else {
			$email = $this->input->post("email");
            $user = $this->user->get_user_by_email($this->security->xss_clean($email));
			if(empty($user)) {
				$password = $this->security->xss_clean($this->input->post("password"));
				$data = array(
					"email" => $this->security->xss_clean($email),
					"first_name" => $this->security->xss_clean($this->input->post("first_name")),
					"last_name" => $this->security->xss_clean($this->input->post("last_name")),
					"user_level" => "user",
					"password" => md5($password)
				);
				$this->user->save_user($data);
				$this->load->view("signin");
			}
			else {
				$this->session->set_flashdata("email_taken", "Email already taken!");
				$this->load->view('register');
			}
        }
	}

	/*DOCU This function is triggered when the user fills up the signin form 
	Checks if the entered fields are valid, alerts the user for any error on the form
	Owner:Philip */
	public function process_signin() {
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("password", "Password", "required");

		if ($this->form_validation->run() == FALSE) {
            $this->load->view('signin');
        }
        else {
			$email = $this->security->xss_clean($this->input->post("email"));
			$password = $this->security->xss_clean($this->input->post("password"));
            $enc_password = md5($password);
			$query = $this->user->get_user_by_email($email);
			if($query[0]->password == $enc_password) {
				$this->session->set_userdata("user", $query[0]);
				if($query[0]->user_level == "admin") {
					$data["users"] = $this->user->get_users();
					redirect("admin");
				}
				else {
					redirect("users/user_dashboard");
				}
			}
			else {
				$this->session->set_flashdata("signin_error", "Incorrect username or password");
				$this->load->view('signin');
			}
        }
	}

	/*DOCU This loads the add user view for the admin page. Owner:Philip */
	public function add() {
		$this->load->view("admin/add");
	}

	/*DOCU This loads the edit user view for admin page. Owner:Philip */
	public function edit($id) {
		$data["user"] = $this->user->get_user_by_id($id);
		$this->load->view("admin/edit", $data);
	}

	/*DOCU This loads the edit user view for user page. Owner:Philip */
	public function edit_user($id) {
		$data["user"] = $this->user->get_user_by_id($id);
		$this->load->view("users/edit", $data);
	}

	/*DOCU This function is triggered when the clicks the edit user info. 
	Checks if the entered fields are valid, alerts the user for any error on the form
	Owner:Philip */
	public function edit_info() {
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("first_name", "First name", "required");
		$this->form_validation->set_rules("last_name", "Last name", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->edit($this->input->post("id"));
		}
		else {
			$data = array(
				"id" => $this->input->post("id"),
				"email" => $this->input->post("email"),
				"first_name" => $this->input->post("first_name"),
				"last_name" => $this->input->post("last_name"),
				"user_level" => $this->input->post("user_level")
			);
			$this->user->update_user($data);
			$this->session->set_flashdata("info_success", "User successfully updated");
			redirect("admin");
		}
	}

	/*DOCU This function is triggered when the clicks the edit user info. 
	Checks if the entered fields are valid, alerts the user for any error on the form
	Owner:Philip */
	public function edit_password() {
		$this->form_validation->set_rules("password", "Password", "required|min_length[6]|matches[confirm]");
		$this->form_validation->set_rules("confirm", "Confirm password", "required|matches[password]");
		if ($this->form_validation->run() == FALSE) {
			$this->edit($this->input->post("id"));
		}
		else {
			$password = $this->input->post("password");
			$enc_password = md5($password);
			$data = array(
				"id" => $this->input->post("id"),
				"password" => $enc_password
			);
			$this->user->update_password($data);
			$this->session->set_flashdata("info_success", "Password update successful");
			redirect("admin");
		}
	}

	/*DOCU This function is triggered when user the clicks the save user description. 
	Checks if the textarea is not empty
	Owner:Philip */
	public function save_description() {
		$this->form_validation->set_rules("description", "Description", "required");
		if ($this->form_validation->run() == FALSE) {
			$this->edit_user($this->input->post("id"));
		}
		else {
			$data = array(
				"id" => $this->input->post("id"),
				"description" => $this->input->post("description")
			);
			$this->user->save_description($data);
			$this->session->set_flashdata("info_success", "Description successfully updated");
			redirect("users/user_dashboard");
		}
	}

	/*DOCU This function is triggered when the clicks the add user button. 
	Checks if the entered fields are valid, alerts the user for any error on the form
	Owner:Philip */
	public function add_user () {
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("first_name", "First name", "required|min_length[3]");
		$this->form_validation->set_rules("last_name", "Last name", "required|min_length[2]");
		$this->form_validation->set_rules("password", "Password", "required|min_length[6]|matches[confirm]");
		$this->form_validation->set_rules("confirm", "Confirm password", "required|matches[password]");

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata("email_taken", "");
			$this->load->view('admin/add');
		}
		else {
			$email = $this->input->post("email");
			$user = $this->user->get_user_by_email($this->security->xss_clean($email));
			if(empty($user)) {
				$password = $this->security->xss_clean($this->input->post("password"));
				$data = array(
					"email" => $this->security->xss_clean($email),
					"first_name" => $this->security->xss_clean($this->input->post("first_name")),
					"last_name" => $this->security->xss_clean($this->input->post("last_name")),
					"user_level" => "user",
					"password" => md5($password)
				);
				$this->user->save_user($data);
				redirect("admin");
			}
			else {
				$this->session->set_flashdata("email_taken", "Email already taken!");
				$this->load->view('admin/add');
			}
		}
	}

	/*DOCU This function adds post to the database. Owner:Philip */
	public function add_message($id) {
		$user = $this->session->userdata("user");
		$data = array(
			"user_id" => $user->id,
			"page_id" => $id,
			"message" => $this->security->xss_clean($this->input->post("message"))
		);
		$this->message->save_message($data);
		redirect("users/show/".$this->input->post("id"));
	}

	/*DOCU This function adds comment to a post. Owner:Philip */
	public function add_comment($id) {
		$user = $this->session->userdata("user");
		$data = array(
			"user_id" => $this->security->xss_clean($user->id),
			"message_id" => $this->security->xss_clean($this->input->post("message_id")),
			"page_id" => $id,
			"comment" => $this->security->xss_clean($this->input->post("comment"))
		);
		$this->comment->save_comment($data);
		redirect("users/show/".$id);
	}

	/*DOCU This function deletes a user with id number that matches the passed id. Owner:Philip */
	public function remove($id) {
		$this->user->delete($id);
		redirect("admin");
	}
}
