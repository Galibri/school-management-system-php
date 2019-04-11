<?php require_once "includes/header.php"; ?>

<?php
	$username = $_SESSION['username'];

	$select_student = "SELECT * FROM students WHERE student_email='$username' AND student_status='active'";
	$student_result = mysqli_query($conn, $select_student);

	if(mysqli_num_rows($student_result) <= 0) {
		header("Location: index.php");
	}

	$student = mysqli_fetch_assoc($student_result);

	$student_email = $student['student_email'];
	$student_name = $student['student_name'];
	$student_class = $student['student_class'];
	$student_section = $student['student_section'];
	$student_group = $student['student_group'];
	$student_roll = $student['student_roll'];

	$select_global_name_id = "SELECT * FROM sections WHERE class_id=$student_class AND section='$student_section' AND group_name='$student_group'";

	$global_name_id_res = mysqli_query($conn, $select_global_name_id);

	if(!$global_name_id_res)die(mysqli_error($conn));

	$row = mysqli_fetch_assoc($global_name_id_res);

	$global_name_id = $row['id'];


?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<?php require_once 'sidebar.php'; ?>
		</div>
		<div class="col-md-8">
			<div class="panel panel-info">
			<div class="panel-heading">Here is your class routine!</div>
			<table class="table table-striped table-bordered" id="printTable">
				<thead>
					<tr>
						<th>Subject</th>
						<th>Teacher</th>
						<th>Days</th>
						<th>Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "SELECT class_teacher.teacher_email, class_teacher.class_days, class_teacher.class_time, subjects.subject FROM class_teacher INNER JOIN subjects ON class_teacher.subject_name_id=subjects.id WHERE class_teacher.global_name_id=$global_name_id";

					$result = mysqli_query($conn, $query);
					if(!$result) {
						die(mysqli_error($conn));
					}

					while ($data = mysqli_fetch_assoc($result)) {
						$subject = $data['subject'];
						$teacher = teacher_name_by_email($data['teacher_email']);
						$time = $data['class_time'];

						$booked_days_encoded = $data['class_days'];
						$class_days_decoded = json_decode($booked_days_encoded, true);
						$class_days_string = implode(", ", $class_days_decoded);

						echo "<tr>";
						echo "<td>$subject</td>";
						echo "<td>$teacher</td>";
						echo "<td>$class_days_string</td>";
						echo "<td>$time</td>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
			</div>
			<div style="margin-top: 20px;"></div>
			<a href="#" onclick='printData();' class="btn btn-info pull-right">Print</a>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>