<?php require_once "includes/header.php"; ?>
	<h1>Gallery Page Content</h1>
	<?php gallery_content_update(); ?>
	<?php delete_gallery_image(); ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="">Add Gallery Image</label>
			<input type="file" class="form-control" name="gallery_content">
		</div>
		<div class="form-group">
			<input type="submit" value="Save" class="btn btn-info" name="save_gallery_content">
		</div>
	</form>

	<?php 
		$query = "SELECT * FROM page_contents WHERE page_name='gallery_page'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$image = $row['page_image'];
			$image_id = $row['id'];
	?>
		
		<div class="col-md-3" style="margin-bottom: 30px;">
			<img src="../assets/images/gallery-image/<?php echo $image; ?>" width="100%" height="150" alt="gallery">
			<a href="content_gallery.php?delete-image=<?php echo $image_id; ?>" class="btn btn-danger hidden-del-field">Delete</a>
		</div>

	<?php } ?>
						
<?php require_once "includes/footer.php"; ?>