<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	if($this->session->userdata("user") == null && $this->session->userdata("user")->user_level != "admin") {
		redirect("users");
	}
	$success = $this->session->flashdata("info_success");
	$this->load->view("templates/header");
?>

<div class="container mt-4">
	<div class="row">
		<div class="col-sm"><h2>Manage Users</h2></div>
		<div class="col-sm"></div>
		<div class="col-sm text-end"><a class="btn btn-primary" href="/users/add">Add new</a></div>
	</div>

	<table class="table table-primary table-striped mt-4">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Created</th>
				<th>User Level</th>
				<th>Actions</th>
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
					<td>
						<a href="/users/edit/<?=$user->id?>">edit</a>
						<a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#modal">
  							delete
						</a>
					</td>
				</tr>
<?php 		endforeach?>
		</tbody>
	</table>
	<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-danger" id="exampleModalLabel">Delete User</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete this user?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<a href="/users/remove/<?=$user->id?>" class="btn btn-danger">Delete</a>
				</div>
			</div>
		</div>
	</div>
<?php if($success): ?>
		<div class="alert alert-success" role="alert">
			<p class="text-center"><?=$success?></p>
		</div>
<?php endif ?>
</div>
<?php $this->load->view("templates/footer"); ?>
  