<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$user = $this->session->userdata("user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../../../css/styles.css">
	<title>User Dashboard</title>
</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">

				<a href="<?=isset($user) && $user->user_level=='admin'? '/admin':'/users/user_dashboard'?>" class="navbar-brand"><?=isset($user) ? ucfirst($user->user_level) : ""?> Dashboard</a>
<?php 			if($user):?>
					<a class="nav-link active text-light" href="/users/edit_user/<?=$user->id?>">Profile</a>
<?php 			endif ?>
				<a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</a>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
					<div class="navbar-nav">
<?php 					if(isset($user)): ?>
							<a class="nav-link active" href="#"><?=$user->first_name?></a>
							<a class="nav-link active" href="/admin/logout">Log Out</a>
<?php 					endif ?>
<?php 					if(!isset($user)): ?>
						<a class="nav-link active" aria-current="page" href="/users/register">Register</a>
						<a class="nav-link" href="/users/signin">Sign In</a>
<?php 					endif ?>
						<
					</div>
				</div>
			</div>
		</nav>
	
	