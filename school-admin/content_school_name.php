<?php require_once "includes/header.php"; ?>
	<h1>School Name</h1>
	<?php school_name_update(); ?>
	<form action="" method="post">
		<div class="form-group">
			<label for="">School Name</label>
			<input type="text" name="school_name" class="form-control" value="<?php echo get_school_name(); ?>">
		</div>
		<div class="form-group">
			<input type="submit" value="Save" class="btn btn-info" name="save_school_name">
		</div>
	</form>
						
<?php require_once "includes/footer.php"; ?>