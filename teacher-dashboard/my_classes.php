<?php require_once "includes/header.php"; ?>
<div class="panel panel-info">
<div class="panel-heading"><h3>Here is your class lists</h3></div>
<table class="table table-bordered table-stripe">
	<thead>
		<tr>
			<th>Class</th>
			<th>Subject</th>
			<th>Time</th>
			<th>Days</th>
			<th>My Students</th>
			<th>Take Attendance</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				$session_user = clean_data($_SESSION['username']);
				$query = "SELECT *, class_teacher.is_class_teacher, class_teacher.subject_name_id as subject_id FROM sections INNER JOIN class_teacher ON sections.id=class_teacher.global_name_id AND class_teacher.teacher_email='$session_user'";
				$result = mysqli_query($conn, $query);
				if(!$result) {
					die(mysqli_error($conn));
				}
				while($row = mysqli_fetch_assoc($result)) {

					$my_class = $row['global_name'];
					$is_class_teacher = $row['is_class_teacher'];
					$class_time = $row['class_time'];
					$global_name_id = $row['global_name_id'];
					$subject_id = $row['subject_id'];
					$class_days_encoded = $row['class_days'];
					$class_days_decoded = json_decode($class_days_encoded, true);
					$class_days = implode(", ", $class_days_decoded);


					echo "<tr>";
					echo "<td>$my_class</td>";
					echo "<td>".get_subject_name_by_id($subject_id)."</td>";
					echo "<td>$class_time</td>";
					echo "<td>$class_days</td>";
					echo "<td><a href='my_students.php?global_name_id=$global_name_id' class='btn btn-info'>View Student</a></td>";
					if($is_class_teacher == 'Y') {
						echo "<td><a href='take_attendance.php?global_name_id=$global_name_id' class='btn btn-info'>Take Attendance</a></td>";
					} else {
						echo "<td>No access</td>";
					}
					echo "</tr>";

				}
			?>			
		</tr>
	</tbody>
</table>
</div>

<?php require_once "includes/footer.php"; ?>