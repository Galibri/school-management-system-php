<?php require_once "includes/header.php"; ?>
<div class="panel panel-info">
<div class="panel-heading"><h2 class="text-center">All students of this class</h2></div>
<table class="table table-bordered table-stripe">
	<thead>
		<tr>
			<th>Student ID</th>
			<th>Name</th>
			<th>Roll</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
			if(isset($_GET['global_name_id'])) {

				$session_user = clean_data($_SESSION['username']);
				$global_name_id = $_GET['global_name_id'];

				$query = "SELECT * FROM sections WHERE id=$global_name_id";
				$result = mysqli_query($conn, $query);

				if(!$result) {
					die(mysqli_error($conn));
				}

				while($row = mysqli_fetch_assoc($result)) {

					$class_id = $row['class_id'];
					$section = $row['section'];
					$group = $row['group_name'];

					$select_students = "SELECT * FROM students WHERE student_class=$class_id AND student_section='$section' AND student_group='$group' AND student_status='active'";

					$student_result = mysqli_query($conn, $select_students);
					if(!$student_result) {
						die(mysqli_error($conn));
					}
					while($students = mysqli_fetch_assoc($student_result)) {
						$std_id = $students['student_email'];
						$std_name = $students['student_name'];
						$std_roll = $students['student_roll'];

						echo "<tr>";
						echo "<td>$std_id</td>";
						echo "<td>$std_name</td>";
						echo "<td>$std_roll</td>";
						echo "</tr>";
					}
				}
			} else {
				header("Location: my_classes.php");
			}
			?>			
		</tr>
	</tbody>
</table>
</div>
<?php require_once "includes/footer.php"; ?>