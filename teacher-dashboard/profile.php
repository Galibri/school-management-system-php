<?php require_once "includes/header.php"; ?>
<?php
	$username = $_SESSION['username'];

	$select_user = "SELECT * FROM user WHERE username='$username'";
	$user_result = mysqli_query($conn, $select_user);
	$user = mysqli_fetch_assoc($user_result);

	$fnmae = $user['user_firstname'];
	$lnmae = $user['user_lastname'];



	$select_teacher = "SELECT * FROM teachers WHERE teacher_email='$username'";
	$teacher_result = mysqli_query($conn, $select_teacher);
	$teacher = mysqli_fetch_assoc($teacher_result);

	$teacher_designation = $teacher['teacher_designation'];
	$teacher_gender = $teacher['teacher_gender'];
	$teacher_qulaification = $teacher['teacher_qualification'];
	$teacher_email = $teacher['teacher_email'];
	$teacher_address = $teacher['teacher_address'];
	$teacher_contact = $teacher['teacher_contact'];
	$teacher_image = $teacher['teacher_image'];

	
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<img src="../assets/images/teacher-images/<?php echo $teacher_image; ?>" width="250px" alt="">
		</div>
		<div class="col-md-8">
			<div class="panel panel-info">
			<div class="panel-heading"><h2>Wecome</h2></div>
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
						<td><?php echo $fnmae. " " .$lnmae; ?></td>
					</tr>
					<tr>
						<td>Designation</td>
						<td><?php echo $teacher_designation; ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?php echo $teacher_gender; ?></td>
					</tr>
					<tr>
						<td>Qualification</td>
						<td><?php echo $teacher_qulaification; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $teacher_email; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><?php echo $teacher_address; ?></td>
					</tr>
					<tr>
						<td>Contact</td>
						<td><?php echo $teacher_contact; ?></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>


<?php require_once "includes/footer.php"; ?>