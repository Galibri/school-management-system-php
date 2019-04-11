<?php require_once "includes/header.php"; ?>
	<h1>Class Time</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Class Time</th>
								<th>Edit</th>
								<th>Delete <input type="checkbox" class="delete-modify"></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM classtime ORDER BY class_time ASC";
								$result = mysqli_query($conn, $query);
								if(!$result) {
									die(mysqli_error($conn));
								}
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>".$row['id']."</td>";
									echo "<td>".$row['class_time']."</td>";
									echo "<td><a href='class_time.php?edit_class_time=".$row['id']."' class='btn btn-warning'>Edit</a></td>";
									echo "<td><button onclick='confirm_delete(".$row['id'].")' class='btn btn-danger delete-hidden'>Delete</button><span class='text-danger shwo-text'>Edit instead of Deleting.</span></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<?php
					if(isset($_GET['edit_class_time'])) {
						$class_time_id = $_GET['edit_class_time'];
						update_class_time($class_time_id);
					?>
					<form action="" method="post">
						<div class="form-group">
							<label for="">Update Class Time</label>
							<input type="text" name="class_time" class="form-control" value="<?php echo get_class_time_by_id($class_time_id); ?>">
						</div>
						<div class="form-group">
							<input type="submit" name="update_class_time_submit" value="Update Class Time" class="btn btn-info">
						</div>
					</form>
					<?php } else { ?>
					<?php add_class_time(); ?>
					<form action="" method="post">
						<div class="form-group">
							<label for="">Class Time</label>
							<input type="text" name="class_time" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="class_time_submit" value="Add Class Time" class="btn btn-info">
						</div>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>

<script>
	$(document).ready(function() {
		$(".delete-hidden").hide();
		$(".delete-modify").on('click', function() {
			var value = $(this).val();
			if($(this).prop('checked') == true) {
				$(".shwo-text").hide();
				$(".delete-hidden").show();
			} else {
				$(".delete-hidden").hide();
				$(".shwo-text").show();
			}
		});
	});
	function confirm_delete(id) {
		var message = "Are you sure to delete? This will delete the related class schedule as well. We recommend you to edit/update instead.";
		if(confirm(message)) {
			$.ajax({
				url: 'delete_class_time.php',
				type: 'POST',
				data: {id: id},
				success: function(data) {
					alert("DELETED.");
					location.reload();
				}
			});
			
		}
		//var id = $(".delete-id").attr('data-id').val();
		//alert(id);
	}
</script>
<?php require_once "includes/footer.php"; ?>