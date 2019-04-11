<?php require_once "includes/header.php"; ?>
<?php

	if(isset($_POST['update_students_class'])) {

		$class_array = [6, 7, 8, 9, 10];
		$exam_type = 'final';

		foreach ($class_array as $key => $value) {

			get_all_students_result_by_class($value, $exam_type);
			update_roll_for_new_exam($value);
			make_failed_students_inactive($value, $exam_type);
			move_students_to_the_next_class($value, $exam_type);
		}
	}
	
?>

<div class="panel panel-danger">
	<div class="panel-heading"><h3 class="text-center">Calculate Result and Update Students Class</h3></div>
	<div class="panel-body">
		<?php
			$ready_to_go = check_result_submission_by_teachers();
			$is_inactive = empty_grading_result();
			if($ready_to_go == 'ready' && $is_inactive== false) {
				echo "<h3 class='text-center'>You are ready to update the students class!</h3>";
				echo "<input type='hidden' class='submit_btn_checker' value='ready'>";
			} else {
				echo "<input type='hidden' class='submit_btn_checker' value='not_ready'>";
			}
			if($is_inactive == true) {
				echo "<h3 class='text-center'>You have updated the results. Do it next year again!</h3>";
				echo "<style>.update_student_btn{display: none;}</style>";
			}

			if(isset($_GET['message']) && $_GET['message'] == 'success') {
				echo '<h2 class="text-center text-success">All Students Updated!</h2>';
			}
		?>
		<hr>
		<div class="col-md-4 col-md-offset-4">
			<form action="" method="post">
				<div class="form-group">
					<input type="submit" class="btn btn-block btn-lg btn-warning update_student_btn" name="update_students_class" value="Update Students Class">
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var submit_checker = $('.submit_btn_checker').val();
		if(submit_checker == 'not_ready'){
			$('.update_student_btn').attr('disabled', 'disabled');
		} else {
			$('.update_student_btn').attr('disabled', false);
		}
	});
</script>

<?php require_once "includes/footer.php"; ?>