<?php require_once "includes/header.php"; ?>
	<h1>Subjects</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<?php delete_subject(); ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Subject</th>
								<th>Edit</th>
								<th>Delete <input type="checkbox" class="delete-modify"></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM subjects ORDER BY subject ASC";
								$result = mysqli_query($conn, $query);
								if(!$result) {
									die(mysqli_error($conn));
								}
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>".$row['id']."</td>";
									echo "<td>".$row['subject']."</td>";
									echo "<td><a href='subjects.php?edit_subject=".$row['id']."' class='btn btn-warning'>Edit</a></td>";
									echo "<td><a href='subjects.php?delete_subject=".$row['id']."' class='btn btn-danger delete-hidden'>Delete</a><span class='text-danger shwo-text'>Edit instead of Deleting.</span></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				<?php if(isset($_GET['edit_subject'])) { ?>
				<div class="col-md-6">
					<?php update_subject($_GET['edit_subject']); ?>
					<?php
						$subject = $_GET['edit_subject'];
						$query2 = "SELECT * FROM subjects WHERE id=$subject";
						$result2 = mysqli_query($conn, $query2);
						$row2 = mysqli_fetch_assoc($result2);
					?>
					<form action="" method="post">
						<div class="form-group">
							<label for="">Update Subject</label>
							<input type="text" name="subject" class="form-control" value="<?php echo $row2['subject']; ?>">
						</div>
						<div class="form-group">
							<input type="submit" name="subject_update_submit" value="Update Subject" class="btn btn-warning">
						</div>
					</form>
				</div>
				<?php } else { ?>
				<div class="col-md-6">
					<?php add_subject(); ?>
					<form action="" method="post">
						<div class="form-group">
							<label for="">Subjects</label>
							<input type="text" name="subject" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="subject_submit" value="Add Subject" class="btn btn-info">
						</div>
					</form>
				</div>
				<?php } ?>
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
</script>
<?php require_once "includes/footer.php"; ?>