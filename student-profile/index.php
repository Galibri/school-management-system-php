<?php require_once "includes/header.php"; ?>

<?php
	$username = $_SESSION['username'];

	$select_student = "SELECT * FROM students WHERE student_email='$username'";
	$student_result = mysqli_query($conn, $select_student);
	$student = mysqli_fetch_assoc($student_result);

	$student_email = $student['student_email'];
	$student_name = $student['student_name'];
	$student_class = $student['student_class'];
	$student_section = $student['student_section'];
	$student_group = $student['student_group'];
	$student_roll = $student['student_roll'];
	$student_father_name = $student['student_father_name'];
	$student_mother_name = $student['student_mother_name'];
	$student_address = $student['student_address'];
	$student_contact = $student['student_contact'];
	$student_dob = $student['student_dob'];
	$student_blood_group = $student['student_blood_group'];
	$student_gender = $student['student_gender'];
	$student_status = $student['student_status'];

	
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<?php require_once 'sidebar.php'; ?>
		</div>
		<div class="col-md-8">
			<div class="panel panel-info">
			<div class="panel-heading">Welcome!</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Attribute</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Name</td>
						<td><?php echo $student_name; ?></td>
					</tr>
					<tr>
						<td>ID</td>
						<td><?php echo $student_email; ?></td>
					</tr>
					<tr>
						<td>Class</td>
						<td><?php echo $student_class; ?></td>
					</tr>
					<tr>
						<td>Section</td>
						<td><?php echo $student_section; ?></td>
					</tr>
					<tr>
						<td>Group</td>
						<td><?php echo $student_group; ?></td>
					</tr>
					<tr>
						<td>Roll</td>
						<td><?php echo $student_roll; ?></td>
					</tr>
					<tr>
						<td>Father's Name</td>
						<td><?php echo $student_father_name; ?></td>
					</tr>
					<tr>
						<td>Mother's Name</td>
						<td><?php echo $student_mother_name; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><?php echo $student_address; ?></td>
					</tr>
					<tr>
						<td>Parent's Contact</td>
						<td><?php echo $student_contact; ?></td>
					</tr>
					<tr>
						<td>Date of birth</td>
						<td><?php echo $student_dob; ?></td>
					</tr>
					<tr>
						<td>Blood Group</td>
						<td><?php echo $student_blood_group; ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?php echo $student_gender; ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><?php echo $student_status; ?></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>