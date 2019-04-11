<?php require_once "includes/header.php"; ?>
<h2 class="text-center">Select date, take attendance and hit submit.</h2>

<?php
	if(isset($_GET['global_name_id'])) {
		$global_name_id = $_GET['global_name_id'];
	}
?>
<input id='thisclass' type='hidden' value='<?php echo $global_name_id; ?>' >

<form action="" method="post">
	<div class="col-md-6 col-md-offset-3">
		<div class="form-group">
			<label for="">Select Date</label>
			<input type="text" name="select_date" class="custom-date select_date form-control" placeholder="YYYY/MM/DD" value="" autocomplete="off">
		</div>
	</div>

	<div id="error-msg"></div>
	
<table class="table table-bordered table-stripped make-hidden">
	<thead>
		<tr>
			<th>Student ID</th>
			<th>Name</th>
			<th>Roll</th>
			<th>Attendence</th>
		</tr>
	</thead>
	<tbody>
			<?php
			if(isset($_GET['global_name_id'])) {

				$session_user = clean_data($_SESSION['username']);
				$global_name_id = $_GET['global_name_id'];

				$total_students = [];

				$query = "SELECT * FROM sections WHERE id=$global_name_id";
				$result = mysqli_query($conn, $query);

				if(!$result) {
					die(mysqli_error($conn));
				}

				while($row = mysqli_fetch_assoc($result)) {

					$class_id = $row['class_id'];
					$section = $row['section'];
					$group = $row['group_name'];

					$select_students = "SELECT * FROM students WHERE student_class=$class_id AND student_section='$section' AND student_group='$group' AND student_status='active' ORDER BY id ASC";

					$student_result = mysqli_query($conn, $select_students);
					if(!$student_result) {
						die(mysqli_error($conn));
					}
					while($students = mysqli_fetch_assoc($student_result)) {
						$std_id = $students['student_email'];
						$total_students[] = $std_id;
						$std_name = $students['student_name'];
						$std_roll = $students['student_roll'];

						echo "<tr>";
						echo "<td>$std_id</td>";
						echo "<td>$std_name</td>";
						echo "<td>$std_roll</td>";
						echo "<td>
							<input type='checkbox' class='form-control student_id' name='attendance[]' std_id='{$std_id}' std-roll='{$std_roll}'>
							<input type='hidden' class='student-{$std_roll}' name='myid[]' value=''>

						</td>";
						echo "</tr>";
					}
				}
			} else {
				header("Location: my_classes.php");
			}
			?>
		<tr>
			<td colspan="4" class="text-center">
				<input type="submit" name="attendance_submit" class="btn btn-info" value="Submit">
			</td>
		</tr>
	</tbody>
</table>
</form>

<script>
	$(document).ready(function() {
		$('.make-hidden').hide();

		$('.select_date').on('change', function() {
			$("#error-msg").empty();

			var datess = $(this).val();
			var classs = $('#thisclass').val();
			$.ajax({
				url: 'attendance_checker.php',
				type: 'POST',
				data: {classs: classs, datess: datess},
				success: function(data) {
					if(data) {
						$('.make-hidden').hide();
						$('.success-msg').hide();
						$("#error-msg").html("<div class='col-md-12 text-center'><h3>Attendance taken on this day.</h3></div>");
					} else {
						$('.make-hidden').show();
					}
				}		
			});
			
		});

		$('.student_id').on('click', function(){
			var checked = $(this).attr('std_id');

			if($(this).prop('checked') == true) {
				$(this).attr('value', checked);
			} else {
				$(this).attr('value', '');
			}
		});
	});
</script>

<?php require_once "includes/footer.php"; ?>

<?php
	if(isset($_POST['attendance_submit']) && isset($_POST['attendance'])) {

		$students_attendance = $_POST['attendance'];
		$class_date = $_POST['select_date'];

		// var_dump($students_attendance);
		// var_dump($total_students);

		foreach ($total_students as $key => $student) {
			if(in_array($student, $students_attendance)) {
				$attendance_val = "Y";
			} else {
				$attendance_val = "N";
			}
			$query = "INSERT INTO attendance (dates, student_id, attendance, global_name_id, teacher_email) VALUES ('$class_date', '$student', '$attendance_val', '$global_name_id', '$session_user')";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die(mysqli_error($conn));
			}
		}
		echo "<div class='col-md-12 text-center success-msg'><h3>Done!</h3></div>";
	}


?>