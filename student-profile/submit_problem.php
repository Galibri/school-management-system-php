<?php require_once "includes/header.php"; ?>

<?php
	$username = $_SESSION['username'];
	if(isset($_POST['message_submit'])) {
		$subject= $_POST['subject'];
		$message= wordwrap($_POST['message'], 70);
		$done = mail("admin@school.com",$subject,$message);
		if($done) {
			echo "<script>alert('Message Sent!')</script>";
		}
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<?php require_once 'sidebar.php'; ?>
		</div>
		<div class="col-md-8">
			<form action="" method="post">
				<div class="form-group">
					<label for="">Subject</label>
					<input type="text" name="subject" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Message</label>
					<textarea name="message" id="" class="form-control" cols="30" rows="10" placeholder="Type your message..."></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="message_submit" class="btn btn-info pull-right" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>