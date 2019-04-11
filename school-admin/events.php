<?php require_once "includes/header.php"; ?>
	<h1>Events <span class="pull-right"><a href="events.php?action=add_new" class="btn btn-info">Add new events</a></span></h1>
	<?php 
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		} else {
			$action = "";
		}
		switch ($action) {
			case 'add_new':
				require_once "events/add_new_event.php";
				break;

			case 'edit_event':
				require_once "events/edit_event.php";
				break;

			case 'delete_event':
				require_once "events/delete_event.php";
				break;
			
			default:
				require_once "events/all_events.php";
				break;
		}
	?>
						
<?php require_once "includes/footer.php"; ?>