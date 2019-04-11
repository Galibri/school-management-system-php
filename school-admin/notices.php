<?php require_once "includes/header.php"; ?>
	<h1>Notice <span class="pull-right"><a href="notices.php?action=add_new" class="btn btn-info">Add new notice</a></span></h1>
	<?php 
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		} else {
			$action = "";
		}
		switch ($action) {
			case 'add_new':
				require_once "notices/add_new_notice.php";
				break;

			case 'edit_notice':
				require_once "notices/edit_notice.php";
				break;

			case 'delete_notice':
				require_once "notices/delete_notice.php";
				break;
			
			default:
				require_once "notices/all_notices.php";
				break;
		}
	?>
						
<?php require_once "includes/footer.php"; ?>