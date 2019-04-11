<?php require_once "includes/header.php"; ?>
	<h1>Gallery Page Content</h1>
	<?php logo_content_update(); ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="">Add Gallery Image</label>
			<input type="file" class="form-control" name="logo_content">
		</div>
		<div class="form-group">
			<input type="submit" value="Save" class="btn btn-info" name="save_logo_content">
		</div>
	</form>

	<?php 
		$query = "SELECT * FROM page_contents WHERE page_name='site_logo'";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$image = $row['page_image'];
	?>
		
		<div class="col-md-3" style="margin-bottom: 30px;">
			<img src="../assets/images/<?php echo $image; ?>" width="auto" height="150" alt="gallery">
		</div>

	<?php } ?>
						
<?php require_once "includes/footer.php"; ?>