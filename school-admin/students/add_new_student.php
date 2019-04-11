<?php $error = register_student(); ?>
<?php 
	if(isset($_GET['message']) && $_GET['message'] == "success") {
		echo "<p class='bg-success'>Student added! <a href='students.php'>View all students here</a></p>";
	}
	if(!empty($error)) {
		echo "<p class='bg-danger'>$error</p>";
	}
?>
<form action="" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label for="">First Name</label>
			<input type="text" name="user_firstname" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Last Name</label>
			<input type="text" name="user_lastname" class="form-control">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Class</label>
			<select name="student_class" class="form-control" id="student-class">
				<option value="">Select Class</option>
				<?php
					$query = "SELECT * FROM class";
					$result = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_assoc($result)) {
						$class_id = $row['id'];
						$class = $row['class'];
						echo "<option value='{$class}'>{$class}</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Section</label>
			<select name="student_section" class="form-control" id="student-section">
				<option value="">Select Section</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</option>
				<option value="D">D</option>
				<option value="E">E</option>
				<option value="F">F</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Groups</label>
			<select name="student_group" class="form-control" id="student-group" readonly>
				<option value="">Select Group</option>
				<option value="Science">Science</option>
				<option value="Humanities">Humanities</option>
				<option value="Commerce">Commerce</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Admission Year</label>
			<select name="admission_year" id="admission_year" class="form-control">
				<option value="">Select One</option>
			<?php
				$year = date("Y");
				$count = $year + 7;
				for($i=$year; $i<$count; $i++) {
					echo "<option value='$i'>$i</option>";
				}
			?>
			</select>
		</div>
	</div>
	<div class="col-md-5">
		<div class="form-group">
			<label for="">Username</label>
			<input type="email" name="username" class="form-control" id="student-username" readonly>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">Password</label>
			<input type="text" name="user_password" class="form-control">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Roll</label>
			<input type="text" name="student_roll" class="form-control" id="student-roll" readonly>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Date of Birth</label>
			<input type="text" name="student_dob" class="form-control custom-date">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Blood Group</label>
			<select name="student_blood_group" class="form-control" id="blood-group">
				<option value="">Select One</option>
				<option value="AB+">AB+</option>
				<option value="A+">A+</option>
				<option value="B+">B+</option>
				<option value="O+">O+</option>
				<option value="AB-">AB-</option>
				<option value="A-">A-</option>
				<option value="B-">B-</option>
				<option value="O-">O-</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Gender</label>
			<select name="student_gender" class="form-control" id="student-gender">
				<option value="">Select One</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
				<option value="Other">Other</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Student Status</label>
			<select name="student_status" class="form-control" id="">
				<option value="active">Active</option>
				<option value="inactive">Inactive</option>
				<option value="completed">Completed</option>
				<option value="failed">Failed</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Father's Name</label>
			<input type="text" name="student_father_name" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Mother's Name</label>
			<input type="text" name="student_mother_name" class="form-control">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Address</label>
			<textarea name="student_address" class="form-control" id="" cols="30" rows="6"></textarea>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="">Parents Contact</label>
			<input type="text" name="student_contact" class="form-control">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<input type="submit" Value="Add Student" class="btn btn-info" name="add_student_btn">
		</div>
	</div>
</form>

<script>
	//select student group
	$(document).on('change', '#student-class', function() {
		$('#student-group').attr('readonly', 'readonly');
		var student_class = $(this).val();
		if(student_class >= 9) {
			$('#student-group').attr('readonly', false);
		} else {
			$('#student-group').val('');
		}
	});

	//auto student id generator
	$(document).on('change', '#student-class, #student-section, #student-group, #admission_year', function() {
		var std_class_name = $("#student-class").val();
		var std_section = $("#student-section").val();
		var std_group_name = $("#student-group").val();
		var admission_year = $("#admission_year").val();
		if(!std_group_name) {
			std_group_name = '';
		}

		switch(std_group_name) {
			case 'Science':
				std_group = '1';
				break;
			case 'Humanities':
				std_group = '2';
				break;
			case 'Commerce':
				std_group = '3';
				break;
			default:
				std_group = '0';
				break;
		}

		switch(std_class_name) {
			case '6':
				std_class = '06';
				break;
			case '7':
				std_class = '07';
				break;
			case '8':
				std_class = '08';
				break;
			case '9':
				std_class = '09';
				break;
			case '10':
				std_class = '10';
				break;
			default:
				std_class = '06';
				break;
		}

		if(std_class && std_section && admission_year) {
			$.ajax({
				url: 'ajax/roll_number_generator.php',
				type: 'POST',
				data: {std_class: std_class, std_section: std_section},
				success: function(data) {
					var full_id = admission_year + std_group + std_section + std_class + data + "@school.com";
					$("#student-username").attr('value', full_id);
					$("#student-roll").attr('value', parseInt(data));
				}
			});
		}
	});

	$(document).on('change', '', function() {

	});

</script>