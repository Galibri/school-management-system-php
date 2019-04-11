<?php require_once "includes/header.php"; ?>
	<h1>Students</h1>
	<?php if(!isset($_GET['action'])) { ?>
		<div class="col-md-8">
			<a href="students.php?action=add_new" class="btn btn-info pull-right">Add new student</a>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<input type="text" id="search-students" class="form-control" name="search_students" placeholder="Student id search..">
			</div>
		</div>
	<?php } ?>
	<?php 
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		} else {
			$action = "";
		}
		switch ($action) {
			case 'add_new':
				require_once "students/add_new_student.php";
				break;

			case 'edit_student':
				require_once "students/edit_student.php";
				break;

			case 'delete_student':
				require_once "students/delete_student.php";
				break;
			
			default:
				require_once "students/all_students.php";
				break;
		}
	?>
						
<?php require_once "includes/footer.php"; ?>