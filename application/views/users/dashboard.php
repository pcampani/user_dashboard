<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	if($this->session->userdata("user") == null) {
		redirect("users");
	}
	$success = $this->session->flashdata("info_success");
	$this->load->view("templates/header");
?>

<div class="container mt-4">
	<h2>All Users</h2>
	<table class="table table-primary table-striped mt-4">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Created</th>
				<th>User Level</th>
			</tr>
		</thead>
		<tbody>
<?php 		foreach($users as $user):?>
				<tr>
					<td><?=$user->id?></td>
					<td><a href="/users/show/<?=$user->id?>"><?=$user->first_name . " " . $user->last_name?></a></td>
					<td><?=$user->email?></td>
					<td><?=date("F jS, Y", strtotime($user->created_at))?></td>
					<td><?=$user->user_level?></td>
				</tr>
<?php 		endforeach?>
		</tbody>
	</table>
<?php if($success): ?>
		<div class="alert alert-success" role="alert">
			<p class="text-center"><?=$success?></p>
		</div>
<?php endif ?>
</div>
  