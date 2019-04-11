<?php require_once "includes/header.php"; ?>
<div class="panel panel-info">
<div class="panel-heading"><h3>Edit Result</h3></div>
<?php
	$session_user = $_SESSION['username'];

	//function to process the class and id
	if(isset($_POST['update_get_class_submit'])) {
		echo $global_name_id = $_POST['select_class'];
		echo $exam_type = $_POST['exam_type'];
		echo $select_subject = $_POST['select_subject'];

		if(!empty($global_name_id) && !empty($exam_type) && !empty($select_subject)) {
			header("Location: edit_result.php?global_name_id=$global_name_id&exam_type=$exam_type&subject=$select_subject");
		} else {
			header("Location: edit_result.php");
		}
	}
?>
<input type="hidden" class="teacher_email" value="<?php echo $session_user; ?>">
<?php if(isset($_GET['message']) && $_GET['message'] == "success") { ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible text-center" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Result Updated!</strong> If you have mistake, update again.
			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php if(!isset($_GET['global_name_id'])) { ?>
<div class="col-md-6 col-md-offset-3">
	<form action="" method="post">
		<div class="form-group">
			<label for="">Select Class</label>
			<select name="select_class" class="form-control" id="class_selector">
				<option value="">Select Class</option>
				<?php
					$query = "SELECT DISTINCT sections.*, class_teacher.global_name_id FROM class_teacher INNER JOIN sections ON class_teacher.global_name_id=sections.id WHERE class_teacher.teacher_email='$session_user'";
					$result = mysqli_query($conn, $query);
					while($row = mysqli_fetch_assoc($result)) {

						$my_class = $row['global_name'];
						$global_name_id = $row['global_name_id'];

						echo "<option value='{$global_name_id}'>{$my_class}</option>";
					}
				?>
			</select>
		</div>
		<div class="form-group" id="subject_selector">
			
		</div>
		<div class="form-group">
			<label for="">Select Exam Type</label>
			<select name="exam_type" class="form-control" id="">
				<option value="">Select Exam Type</option>
				<option value="mid">Mid Term Exam</option>
				<option value="final">Final Exam</option>
			</select>
		</div>
		<div class="form-group">
			<input type="submit" name="update_get_class_submit" value="Submit" class="btn btn-info">
		</div>
	</form>
</div>
<div class="clearfix"></div>

<?php } else { ?>
	<?php
		$global_name_id = $_GET['global_name_id'];
		$exam_type = $_GET['exam_type'];
		$subject_id = $_GET['subject'];
	?>
	<input type="hidden" class="global_name_id" value="<?php echo $global_name_id; ?>">
	<input type="hidden" class="exam_type" value="<?php echo $exam_type; ?>">
	<input type="hidden" class="subject_id" value="<?php echo $subject_id; ?>">

	<div class="panel-body" id="result_info"></div>

<?php } ?>

<script>
	$(document).ready(function() {
		var global_name_id = $('input.global_name_id').val();
		var exam_type = $('input.exam_type').val();
		var teacher_email = $('input.teacher_email').val();
		var subject_id = $('input.subject_id').val();

		if(global_name_id != '' && exam_type != '') {
			$.ajax({
				url: 'update_result_data.php',
				type: 'POST',
				data: {global_name_id: global_name_id, exam_type: exam_type, teacher_email: teacher_email, subject_id: subject_id},
				success: function(data) {
					$("#result_info").html(data);
				}
			});
			
		}
		$(document).on('change', '#class_selector', function() {
			var global_name_id = $(this).val();
			var teacher_email = $('input.teacher_email').val();
			if(global_name_id != '') {
				$.ajax({
					url: 'update_result_subject_selector.php',
					type: 'POST',
					data: {teacher_email: teacher_email, global_name_id: global_name_id},
					success: function(data) {
						$("#subject_selector").html(data);
					}
				});
			}
		});
		$(document).on('keyup', '.student_mark', function() {;
			var mark_val = $(this).val();
			$('.hide-error').hide();

			if(mark_val != '') {
				if($.isNumeric( mark_val )) {
					if(mark_val >= 0 && mark_val <=100) {
						$('.hide-error').hide();
						$('.result_update_submit').attr('disabled', false);
					} else {
						$('.result_update_submit').attr('disabled', 'disabled');
						$(this).after('<span class="text-danger hide-error">Number must be within 0 to 100</span>');
					}

				} else {
					$('.result_update_submit').attr('disabled', 'disabled');
					$(this).after('<span class="text-danger hide-error">Please input only numbers</span>');
				}
			} else {
				$('.hide-error').hide();
			}
		});
	});
</script>

</div>

<?php
	if(isset($_POST['result_update_submit'])) {
		$exam_type = $_GET['exam_type'];
		$subject_id = $_GET['subject'];
		$global_name_id = $_GET['global_name_id'];
		$results = $_POST['marks'];
		$exam_year = $_POST['exam_year'];
		$total_students = get_attendance_total_students($session_user, $global_name_id, $exam_type);
		$combine_results = array_combine($total_students, $results);

		foreach ($combine_results as $key => $marks) {
			if(empty($marks)) {
				$marks = 0;
			}
			$grade = get_grade_by_marks($marks);

			$update_query = "UPDATE results SET marks='$marks', grade=$grade WHERE student_id='$key' AND exam_year='$exam_year'";
			$update_result = mysqli_query($conn, $update_query);
			if($update_result) {
				header("Location: edit_result.php?message=success");
			}
		}
	}
?>

<?php require_once "includes/footer.php"; ?>