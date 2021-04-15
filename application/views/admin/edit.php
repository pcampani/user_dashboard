<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view("templates/header");
?>

<div class="container mt-4">
	<div class="row">
		<div class="col-sm"><h2>Edit User #: <?=$user[0]->id?></h2></div>
		<div class="col-sm"></div>
		<div class="col-sm"><a class="btn btn-primary" href="/admin/home">Return to Dashboard</a></div>
	</div>
	<div class="row mt-4">
		<div class="col-sm">
			<form class="edit_info mb-4" action="/users/edit_info" method="post">
				<h2>Edit Information</h2>
				<div>
					<input type="hidden" name="id" value="<?=$user[0]->id?>">
					<label for="email">Email address</label>
					<input type="text" name="email" class="form-control" value="<?=$user[0]->email?>">
					<span class="error">&nbsp;<?= form_error("email")?></span>
				</div>
				<div>
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" class="form-control" value="<?=$user[0]->first_name?>">
					<span class="error">&nbsp;<?= form_error("first_name")?></span>
				</div>
				<div>
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" class="form-control" value="<?=$user[0]->last_name?>">
					<span class="error">&nbsp;<?= form_error("last_name")?></span>
				</div>
				<div>
					<label for="user_level">User Level</label>
					<select name="user_level">
						<option value="admin" <?=$user[0]->user_level == 'admin' ? "selected" : ""?>>Admin</option>
						<option value="user" <?=$user[0]->user_level == 'user' ? "selected" : ""?>>User</option>
					</select>
				</div>
				<input type="submit" value="Save" class="btn btn-md btn-success">
			</form>
		</div>
		<div class="col-sm"></div>
		<div class="col-sm">
			<form class="edit_password" action="/users/edit_password" method="post">
				<h2>Change Password</h2>
				<div>
					<input type="hidden" name="id" value="<?=$user[0]->id?>">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control">
					<span class="error">&nbsp;<?= form_error("password")?></span>
				</div>
				<div class="mt-4">
					<label for="confirm">Password Confirmation</label>
					<input type="password" name="confirm" class="form-control">
					<span class="error">&nbsp;<?= form_error("confirm")?></span>
				</div>
				<input type="submit" value="Update Password" class="btn btn-md btn-success">
			</form>
		</div>
	</div>
</div>
  