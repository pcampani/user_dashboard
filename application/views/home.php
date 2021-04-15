<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view("templates/header");
?>

<div class="px-4 py-5 my-5 text-center">
  	<h1 class="display-5 fw-bold">User Dashboard</h1>
  	<div class="col-lg-6 mx-auto">
    	<p class="lead mb-4">This app has login and registration features gives users ability to send messages to other users, comments on other messages and edit their profile. Admin can add, edit and delete users.</p>
		<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
			<a href="/users/register" class="btn btn-primary btn-lg px-4 me-sm-3">Let's Start</a>
		</div>
  	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm">
			<h3>Manage Users</h3>
			<p>Using this application you'll learn how to add, remove and edit users of the application</p>
		</div>
		<div class="col-sm">
			<h3>Leave Messages</h3>
			<p>Users will be able to leave messages to another user with this application</p>
		</div>
		<div class="col-sm">
		<h3>Edit User Information</h3>
			<p>Admin will be able to edit another user's information(email address, first name, last name, etc)</p>
		</div>
	</div>
</div>

<?php $this->load->view("templates/footer")?>