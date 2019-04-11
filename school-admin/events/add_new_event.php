<?php add_new_event(); ?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Event added! <a href='events.php'>View all Eventss here</a></p>";
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Event Title</label>
		<input type="text" name="event_title" class="form-control">
	</div>
	<div class="form-group">
		<label for="">Event Description</label>
		<textarea name="event_desc" id="" cols="30" rows="10" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label for="">Event Image</label>
		<input type="file" name="event_image" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" Value="Add Event" class="btn btn-info" name="add_event_btn">
	</div>
</form>