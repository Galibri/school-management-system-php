<?php
	$notice_data = showNoticeData();
	update_notice();
?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Notice updated! <a href='notices.php'>View all noticess here</a></p>";
	}
?>
<form action="" method="post">
	<div class="form-group">
		<label for="">Notice Title</label>
		<input type="text" name="notice_title" class="form-control" value="<?php echo $notice_data['notice_title']; ?>">
	</div>
	<div class="form-group">
		<label for="">Notice Description</label>
		<textarea name="notice_desc" id="" cols="30" rows="10" class="form-control"><?php echo $notice_data['notice_desc']; ?></textarea>
	</div>
	<div class="form-group">
		<input type="submit" Value="Update Notice" class="btn btn-info" name="update_notice_btn">
	</div>
</form>