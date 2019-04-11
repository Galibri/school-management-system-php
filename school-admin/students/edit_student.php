<?php
	$students_data = showStudentsData();
	updateStudentById();
?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Student updated! <a href='students.php'>View all students</a></p>";
	}
?>
<form action="" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label for="">First Name</label>
			<input type="text" name="user_firstname" class="form-control" value="<?php echo $students_data['user_firstname']; ?>" >
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Last Name</label>
			<input type="text" name="user_lastname" class="form-control" value="<?php echo $students_data['user_lastname']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Username</label>
			<input type="email" name="username" class="form-control" value="<?php echo $students_data['username']; ?>" readonly>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Password</label>
			<input type="text" name="user_password" class="form-control">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Class</label>
			<?php
				$s_id = $_GET['s_id'];
				$query = "SELECT student_class FROM students WHERE id=$s_id";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);

				$studentClass = $row['student_class'];
			?>
			<select name="student_class" class="form-control" id="">
				<option value="">Select Class</option>
				<option value="6" <?php echo $studentClass == "6"? "selected" : ""; ?>>6</option>
				<option value="7" <?php echo $studentClass == "7"? "selected" : ""; ?>>7</option>
				<option value="8" <?php echo $studentClass == "8"? "selected" : ""; ?>>8</option>
				<option value="9" <?php echo $studentClass == "9"? "selected" : ""; ?>>9</option>
				<option value="10" <?php echo $studentClass == "10"? "selected" : ""; ?>>10</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Section</label>
			<?php
				$s_id = $_GET['s_id'];
				$query_2 = "SELECT student_section FROM students WHERE id=$s_id";
				$result_2 = mysqli_query($conn, $query_2);
				$row = mysqli_fetch_assoc($result_2);

				$studentSec = $row['student_section'];
			?>
			<select name="student_section" class="form-control" id="student-section">
				<option value="">Select Section</option>
				<option value="A" <?php echo $studentSec == "A"? "selected" : ""; ?>>A</option>
				<option value="B" <?php echo $studentSec == "B"? "selected" : ""; ?>>B</option>
				<option value="C" <?php echo $studentSec == "C"? "selected" : ""; ?>>C</option>
				<option value="D" <?php echo $studentSec == "D"? "selected" : ""; ?>>D</option>
				<option value="E" <?php echo $studentSec == "E"? "selected" : ""; ?>>E</option>
				<option value="F" <?php echo $studentSec == "F"? "selected" : ""; ?>>F</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Groups</label>
			<?php
				$s_id = $_GET['s_id'];
				$query_3 = "SELECT student_group FROM students WHERE id=$s_id";
				$result_3 = mysqli_query($conn, $query_3);
				$row = mysqli_fetch_assoc($result_3);

				$studentGrp = $row['student_group'];
			?>
			<select name="student_group" class="form-control" id="student-group">
				<option value="">Select Group</option>
				<option value="Science" <?php echo $studentGrp == "Science"? "selected" : ""; ?>>Science</option>
				<option value="Humanities" <?php echo $studentGrp == "Humanities"? "selected" : ""; ?>>Humanities</option>
				<option value="Commerce" <?php echo $studentGrp == "Commerce"? "selected" : ""; ?>>Commerce</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Roll</label>
			<input type="text" name="student_roll" class="form-control" value="<?php echo $students_data['student_roll']; ?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Date of Birth</label>
			<input type="text" name="student_dob" class="form-control custom-date" value="<?php echo $students_data['student_dob']; ?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Blood Group</label>
			<?php
				$s_id = $_GET['s_id'];
				$query_4 = "SELECT student_blood_group FROM students WHERE id=$s_id";
				$result_4 = mysqli_query($conn, $query_4);
				$row = mysqli_fetch_assoc($result_4);

				$studentBloodGrp = $row['student_blood_group'];
			?>
			<select name="student_blood_group" class="form-control" id="blood-group">
				<option value="">Select One</option>
				<option value="AB+" <?php echo $studentBloodGrp == "AB+"? "selected" : ""; ?>>AB+</option>
				<option value="A+" <?php echo $studentBloodGrp == "A+"? "selected" : ""; ?>>A+</option>
				<option value="B+" <?php echo $studentBloodGrp == "B+"? "selected" : ""; ?>>B+</option>
				<option value="O+" <?php echo $studentBloodGrp == "O+"? "selected" : ""; ?>>O+</option>
				<option value="AB-" <?php echo $studentBloodGrp == "AB-"? "selected" : ""; ?>>AB-</option>
				<option value="A-" <?php echo $studentBloodGrp == "A-"? "selected" : ""; ?>>A-</option>
				<option value="B-" <?php echo $studentBloodGrp == "B-"? "selected" : ""; ?>>B-</option>
				<option value="O-" <?php echo $studentBloodGrp == "O-"? "selected" : ""; ?>>O-</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Gender</label>
			<?php
				$s_id = $_GET['s_id'];
				$query_5 = "SELECT student_gender FROM students WHERE id=$s_id";
				$result_5 = mysqli_query($conn, $query_5);
				$row = mysqli_fetch_assoc($result_5);

				$studentGender = $row['student_gender'];
			?>
			<select name="student_gender" class="form-control" id="student-gender">
				<option value="">Select One</option>
				<option value="Male" <?php echo $studentGender == "Male"? "selected" : ""; ?>>Male</option>
				<option value="Female" <?php echo $studentGender == "Female"? "selected" : ""; ?>>Female</option>
				<option value="Other" <?php echo $studentGender == "Other"? "selected" : ""; ?>>Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Student Status</label>
			<?php
				$s_id = $_GET['s_id'];
				$query_5 = "SELECT student_status FROM students WHERE id=$s_id";
				$result_5 = mysqli_query($conn, $query_5);
				$row = mysqli_fetch_assoc($result_5);

				$studentSts = $row['student_status'];
			?>
			<select name="student_status" class="form-control" id="">
				<option value="">Select One</option>
				<option value="active" <?php echo $studentSts == "active"? "selected" : ""; ?>>Active</option>
				<option value="inactive" <?php echo $studentSts == "inactive"? "selected" : ""; ?>>Inactive</option>
				<option value="completed" <?php echo $studentSts == "completed"? "selected" : ""; ?>>Completed</option>
				<option value="failed" <?php echo $studentSts == "failed"? "selected" : ""; ?>>Failed</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Father's Name</label>
			<input type="text" name="student_father_name" class="form-control" value="<?php echo $students_data['student_father_name']; ?>">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Mother's Name</label>
			<input type="text" name="student_mother_name" class="form-control" value="<?php echo $students_data['student_mother_name']; ?>">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Address</label>
			<textarea name="student_address" class="form-control" id="" cols="30" rows="6"><?php echo $students_data['student_address']; ?></textarea>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Parents Contact</label>
			<input type="text" name="student_contact" class="form-control" value="<?php echo $students_data['student_contact']; ?>">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<input type="submit" Value="Update Student" class="btn btn-info" name="update_student_btn">
		</div>
	</div>
</form>

<script>
	$(document).on('change', '#student-class', function() {
		$('#student-group').attr('disabled', 'disabled');
		var student_class = $(this).val();
		if(student_class >= 9) {
			$('#student-group').attr('disabled', false);
		}
	});
</script>