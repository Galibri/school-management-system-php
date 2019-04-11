<?php require_once "includes/header.php"; ?>
	<h1>School Address</h1>
	<?php school_address_update(); ?>
	<form action="" method="post">
		<div class="form-group">
			<label for="">Content</label>
			<textarea name="school_address" id="" cols="30" rows="20" class="form-control"><?php 
				echo get_school_address();
			?></textarea>
		</div>
		<div class="form-group">
			<input type="submit" value="Save" class="btn btn-info" name="save_school_address">
		</div>
	</form>
						
<?php require_once "includes/footer.php"; ?>