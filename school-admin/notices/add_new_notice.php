<?php add_new_notice(); ?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Notice added! <a href='notices.php'>View all noticess here</a></p>";
	}
?>
<form action="" method="post">
	<div class="form-group">
		<label for="">Notice Title</label>
		<input type="text" name="notice_title" class="form-control">
	</div>
	<div class="form-group">
		<label for="">Notice Description</label>
		<textarea name="notice_desc" id="" cols="30" rows="10" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" Value="Add Notice" class="btn btn-info" name="add_notice_btn">
	</div>
</form>