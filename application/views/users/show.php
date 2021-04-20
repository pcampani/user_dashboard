<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	$logged_in_user = $this->session->userdata("user");
	$this->load->view("templates/header");
?>
<div class="container mt-4">
<?php foreach($users as $user): ?>
		<h2><?=$user->first_name . " " . $user->last_name?></h2>
		<p>Registered at: <?= date("F jS, Y", strtotime($user->created_at))?></p>
		<p>User ID#: <?=$user->id?></p>
		<p>Email Address: <?=$user->email?></p>
		<p>Description: <?=$user->description?> </p>
		<h3 class="text-primary">Leave a message for <?=$user->first_name?></h3>
<?php endforeach ?>
	<form class="comment" action="/users/add_message/<?=$user->id?>" method="post">
		<input type="hidden" name="id" value="<?=$user->id?>">
		<textarea name="message" class="form-control"></textarea>
		<input class="btn btn-success" type="submit" value="Post">
	</form>
<?php foreach($messages as $message):?>
	<div class="container mt-4">
		<div class="card p-4">
			<div class="row">
				<div class="col-sm-5">
					<h5 class="text-primary"><?= $message->name . " wrote " . date("F jS, h:i A", strtotime($message->created_at))?></h5>
				</div>
				<div class="col-sm-5"></div>
<?php 			if ($message->user_id == $logged_in_user->id): ?>
					<div class="col-sm-2 justify-content-end">
						<a href="" class="btn btn-danger btn-md text-right">Delete</a>
					</div>
<?php			endif ?>
			</div>
		<div class="card-body">
			<p><?= $message->message?></p>
			<p class="text-success bg-dark text-light p-2 mb-2">Post Comments</p>
<?php 		foreach($comments as $comment): ?>
				<div class="row mt-3">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<p class="text-primary"><?=$comment->name?> wrote on <?=date("F jS, h:i A", strtotime($comment->comment_date))?></p>
						<p class="comment-body fst-italic"><?=$comment->comment?></p>
					</div>
					<div class="col-sm-1"></div>
				</div>
<?php		endforeach ?>
		</div>
		<div class="comment row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<form class="comment" action="/users/add_comment/<?=$user->id?>" method="post">
					<input type="hidden" name="message_id" value="<?=$message->id?>">
					<textarea name="comment" class="form-control" placeholder="Write a comment"></textarea>
					<input class="btn btn-success" type="submit" value="Save">
				</form>
			</div>
		</div>
	</div>			
</div>
<?php endforeach?>
</div>
