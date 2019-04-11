<?php
	$event_data = showEventData();
	update_event();
?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Event updated! <a href='events.php'>View all events here</a></p>";
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Event Title</label>
		<input type="text" name="event_title" class="form-control" value="<?php echo $event_data['event_title']; ?>">
	</div>
	<div class="form-group">
		<label for="">Event Description</label>
		<textarea name="event_desc" id="" cols="30" rows="10" class="form-control"><?php echo $event_data['event_desc']; ?></textarea>
	</div>
	<?php if(!empty($event_data['event_image'])) { ?>
		<img src="../assets/images/event-images/<?php echo $event_data['event_image'] ?>" width="100" height="60" alt="Events">
	<?php } ?>
	<div class="form-group">
		<label for="">Event Image</label>
		<input type="file" name="event_image" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" Value="Update Event" class="btn btn-info" name="update_event_btn">
	</div>
</form>