<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view("templates/header");
?>

<div class="container mt-4">
	<div class="row">
		<div class="col-sm"></div>
		<div class="col-sm">
		<form class="signin mb-4" action="/users/process_signin" method="post">
			<h2>Please sign in</h2>
			<div>
				<label for="email">Email address</label>
				<input type="text" name="email" class="form-control" value="<?=set_value("email")?>">
				<span class="error">&nbsp;
					<?= form_error("email")?>
					<?= $this->session->flashdata("signin_error") ?>
				</span>
			</div>
			<div>
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" value="<?=set_value("password")?>">
				<span class="error">&nbsp;<?= form_error("password")?></span>
			</div>
			<input type="submit" value="Sign In" class="btn btn-md btn-primary">
		</form>
		<a href="/users/register">Don't have an account? Register</a>
		</div>
		<div class="col-sm"></div>
	</div>
</div>
  