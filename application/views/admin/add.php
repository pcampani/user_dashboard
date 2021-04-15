<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view("templates/header");
?>

<div class="container mt-4">
	<div class="row">
		<div class="col-sm">
			<form class="register mb-4" action="/users/add_user" method="post">
				<h2>Add a new user</h2>
				<div>
					<label for="email">Email address</label>
					<input type="text" name="email" class="form-control" value="<?=set_value("email")?>">
					<span class="error">&nbsp;<?= form_error("email")?></span>
				</div>
				<div>
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" class="form-control" value="<?=set_value("first_name")?>">
					<span class="error">&nbsp;<?= form_error("first_name")?></span>
				</div>
				<div>
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" class="form-control" value="<?=set_value("last_name")?>">
					<span class="error">&nbsp;<?= form_error("last_name")?></span>
				</div>
				<div>
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" value="<?=set_value("password")?>">
					<span class="error">&nbsp;<?= form_error("password")?></span>
				</div>
				<div>
					<label for="confirm">Password Confirmation</label>
					<input type="password" name="confirm" class="form-control">
					<span class="error">&nbsp;<?= form_error("confirm")?></span>
				</div>
				<input type="submit" value="Create" class="btn btn-md btn-success">
			</form>
		</div>
		<div class="col-sm"></div>
		<div class="col-sm"><a class="btn btn-primary" href="/admin/home">Return to Dashboard</a></div>
	</div>
</div>
  