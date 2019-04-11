<?php $error = register_teacher(); ?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Teacher added! <a href='teachers.php'>View all teachers here</a></p>";
	}
	if(!empty($error)) {
		echo "<p class='bg-danger'>$error</p>";
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="col-md-6">
		<div class="form-group">
			<label for="">First Name</label>
			<input type="text" name="teacher_first_name" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Last Name</label>
			<input type="text" name="teacher_last_name" class="form-control">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">Designation</label>
			<select name="teacher_designation" class="form-control" id="">
				<option value="">Select One</option>
				<option value="Assistant Teacher">Assistant Teacher</option>
				<option value="Senior Teacher">Senior Teacher</option>
				<option value="Junior Teacher">Junior Teacher</option>
				<option value="Headmaster">Headmaster</option>
				<option value="Assistant Headmaster">Assistant Headmaster</option>
				<option value="Sports Teacher">Sports Teacher</option>
				<option value="Proxy Teacher">Proxy Teacher</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">Gender</label>
			<select name="teacher_gender" class="form-control" id="">
				<option value="">Select One</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Other">Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">Email</label>
			<input type="email" name="teacher_email" class="form-control">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Photo</label>
			<input type="file" name="teacher_image" class="form-control">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Qualification</label>
			<textarea name="teacher_qualification" class="form-control" id="" cols="30" rows="6"></textarea>
		</div>
		<div class="form-group">
			<label for="">Address</label>
			<textarea name="teacher_address" class="form-control" id="" cols="30" rows="6"></textarea>
		</div>
		<div class="form-group">
			<label for="">Contact</label>
			<input type="text" name="teacher_contact" class="form-control">
		</div>
		<div class="form-group">
			<label for="">Password</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" Value="Add Teacher" class="btn btn-info" name="add_teacher_btn">
		</div>
	</div>
</form>