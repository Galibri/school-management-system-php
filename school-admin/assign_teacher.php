<?php require_once "includes/header.php"; ?>
	<h1>Assign Teacher to class</h1>
	<?php if(!isset($_GET['action'])) { ?>
		<div class="col-md-12" style="margin-bottom: 20px;">
			<a href="assign_teacher.php?action=add-new" class="btn btn-info pull-right">Assign New Teacher</a>
		</div>
		<!-- <div class="col-md-4">
			<div class="form-group">
				<input type="text" id="search-teacher" class="form-control" name="search_class_time" placeholder="Search Teacher..">
			</div>
		</div> -->
	<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<?php
					if(isset($_GET['action'])) {
						$action = $_GET['action'];
					} else {
						$action = '';
					}
					switch ($action) {
						case 'add-new':
							require_once 'assign-teacher/add-new.php';
							break;
						default:
							require_once 'assign-teacher/view-all.php';
							break;
					}
				?>
			</div>
		</div>

<?php require_once "includes/footer.php"; ?>