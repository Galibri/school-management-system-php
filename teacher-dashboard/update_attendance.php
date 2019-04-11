<?php require_once "includes/header.php"; ?>
<div class="panel panel-info">
<div class="panel-heading"><h3>See/Update attendance</h3></div>
<?php
	$session_user = $_SESSION['username'];
?>

<form action="" method="post">

<?php if(!isset($_GET['global_name_id'])) { ?>
<?php if(isset($_GET['message']) && $_GET['message'] == "updated") { ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Attendance Updated!</strong>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class="panel-body">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Class</th>
					<th>Subject</th>
					<th>Class Time</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT sections.global_name, class_teacher.is_class_teacher, class_teacher.class_time, class_teacher.subject_name_id, class_teacher.global_name_id FROM sections INNER JOIN class_teacher ON class_teacher.global_name_id=sections.id WHERE class_teacher.teacher_email='$session_user'";
					$result = mysqli_query($conn, $query);
					if(!$result){
						die(mysqli_error($conn));
					}
					while ($row = mysqli_fetch_assoc($result)) {
						$global_name = $row['global_name'];
						$global_name_id = $row['global_name_id'];
						$class_time = $row['class_time'];
						$subject_name_id = $row['subject_name_id'];
						echo $is_class_teacher = $row['is_class_teacher'];

						if($is_class_teacher == 'Y') {
							echo "<tr>";
							echo "<td>$global_name</td>";
							echo "<td>". get_subject_name_by_id($subject_name_id) ."</td>";
							echo "<td>$class_time</td>";
							echo "<td><a class='btn btn-info' href='update_attendance.php?global_name_id=$global_name_id'>See/Update attendance</a></td>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php } else { ?>
<?php 
if(isset($_GET['global_name_id'])) {
	$global_name_id = $_GET['global_name_id'];
	echo "<input id='thisclass' type='hidden' value='$global_name_id' >";
}
?>
<div class="col-md-6 col-md-offset-3">
	<div class="form-group">
		<label for="">Select Date</label>
		<input type="text" name="select_date" class="custom-date select_date form-control" placeholder="YYYY/MM/DD" value="" autocomplete="off">
	</div>
</div>
<div class="clearfix"></div>
<div class="panel-body" id="students-info"><div id="error-msg"></div></div>

<?php } ?>
</form>
</div>

<script>
	$(document).ready(function() {

		$('.select_date').on('change', function() {
			$("#error-msg").empty();
			$('#students-info').hide();
			$('.hide-please').hide();

			var attendance_date = $(this).val();
			var attendance_class = $('#thisclass').val();
			$.ajax({
				url: 'attendance_updater.php',
				type: 'POST',
				data: {attendance_date: attendance_date, attendance_class: attendance_class},
				success: function(data) {
					if(data) {
						$('#students-info').show();
						$('#students-info').html(data);
					}
				}		
			});
			
		});

		$(document).on('click', '.student_id', function(){
			var checked = $(this).attr('std_id');

			if($(this).prop('checked') == true) {
				$(this).attr('value', checked);
			} else {
				$(this).attr('value', '');
			}
		});
	});
</script>

<?php
	if(isset($_POST['attendance_update_submit'])) {
		$students_attendance = $_POST['attendance'];
		$class_date = $_POST['select_date'];
		$total_students = get_students_of_teacher($global_name_id, $class_date);

		foreach ($total_students as $key => $student) {
			if(in_array($student, $students_attendance)) {
				$attendance_val = "Y";
			} else {
				$attendance_val = "N";
			}
			$query = "UPDATE attendance SET attendance='$attendance_val' WHERE student_id='$student' AND dates='$class_date'";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die(mysqli_error($conn));
			}
		}
		echo "<div class='col-md-12 text-center success-msg hide-please'><h3>Updated!</h3></div>";
	}
?>

<?php require_once "includes/footer.php"; ?>