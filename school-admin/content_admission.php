<?php require_once "includes/header.php"; ?>
	<h1>Admission Page Content</h1>
	<?php admission_content_update(); ?>
	<form action="" method="post">
		<div class="form-group">
			<label for="">Content</label>
			<textarea name="admission_content" id="" cols="30" rows="20" class="form-control"><?php 
				$query = "SELECT * FROM page_contents WHERE page_name='admission_page'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				echo $row['page_text'];
			?></textarea>
		</div>
		<div class="form-group">
			<input type="submit" value="Save" class="btn btn-info" name="save_admission_content">
		</div>
	</form>
						
<?php require_once "includes/footer.php"; ?>