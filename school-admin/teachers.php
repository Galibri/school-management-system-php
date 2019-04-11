<?php require_once "includes/header.php"; ?>
	<h1>Teachers <span class="pull-right"><a href="teachers.php?action=add_new" class="btn btn-info">Add new teacher</a></span></h1>
	<?php 
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		} else {
			$action = "";
		}
		switch ($action) {
			case 'add_new':
				require_once "teachers/add_new_teacher.php";
				break;

			case 'edit_teacher':
				require_once "teachers/edit_teacher.php";
				break;

			case 'delete_teacher':
				require_once "teachers/delete_teacher.php";
				break;
			
			default:
				require_once "teachers/all_teachers.php";
				break;
		}
	?>
						
<?php require_once "includes/footer.php"; ?>