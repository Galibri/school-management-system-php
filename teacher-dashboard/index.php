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
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Take Attendance</h3>
				</div>
				<div class="panel-body">
					<a href="take_attendance.php" class="btn btn-block btn-lg btn-danger">Take Attendance</a>
				</div>
			</div>
		</div> <!-- col-md-4 -->
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Add Result</h3>
				</div>
				<div class="panel-body">
					<a href="add_result.php" class="btn btn-block btn-lg btn-danger">Add Result</a>
				</div>
			</div>
		</div> <!-- col-md-4 -->
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">My Profile</h3>
				</div>
				<div class="panel-body">
					<a href="profile.php" class="btn btn-block btn-lg btn-danger">My Profile</a>
				</div>
			</div>
		</div> <!-- col-md-4 -->
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">My Classes</h3>
				</div>
				<div class="panel-body">
				<?php
					$session_user = clean_data($_SESSION['username']);
					$query = "SELECT *, class_teacher.subject_name_id as subject_id FROM sections INNER JOIN class_teacher ON sections.id=class_teacher.global_name_id AND class_teacher.teacher_email='$session_user'";
					$result = mysqli_query($conn, $query);
					if(!$result) {
						die(mysqli_error($conn));
					}
					while($row = mysqli_fetch_assoc($result)) {

						$my_class = $row['global_name'];

						echo "<div class='well well-sm'>$my_class</div>";
					}
				?>
				</div>
				<div class="panel-footer text-right"><a href="my_classes.php">Details >></a></div>
			</div>
		</div> <!-- col-md-4 -->
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">My Subjects</h3>
				</div>
				<div class="panel-body">
				<?php
					$session_user = clean_data($_SESSION['username']);
					$query = "SELECT *, class_teacher.subject_name_id as subject_id FROM sections INNER JOIN class_teacher ON sections.id=class_teacher.global_name_id AND class_teacher.teacher_email='$session_user'";
					$result = mysqli_query($conn, $query);
					if(!$result) {
						die(mysqli_error($conn));
					}
					while($row = mysqli_fetch_assoc($result)) {

						$subject_id = $row['subject_id'];

						echo "<div class='well well-sm'>".get_subject_name_by_id($subject_id)."</div>";
					}
				?>
				</div>
				<div class="panel-footer text-right"><a href="my_classes.php">Details >></a></div>
			</div>
		</div> <!-- col-md-4 -->
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">My Class Times</h3>
				</div>
				<div class="panel-body">
				<?php
					$session_user = clean_data($_SESSION['username']);
					$query = "SELECT *, class_teacher.subject_name_id as subject_id FROM sections INNER JOIN class_teacher ON sections.id=class_teacher.global_name_id AND class_teacher.teacher_email='$session_user'";
					$result = mysqli_query($conn, $query);
					if(!$result) {
						die(mysqli_error($conn));
					}
					while($row = mysqli_fetch_assoc($result)) {

						$class_time = $row['class_time'];
						
						echo "<div class='well well-sm'>$class_time</div>";

					}
				?>
				</div>
				<div class="panel-footer text-right"><a href="my_classes.php">Details >></a></div>
			</div>
		</div> <!-- col-md-4 -->
	</div>
</div>

<?php require_once "includes/footer.php"; ?>