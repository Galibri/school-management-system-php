<?php require_once "includes/header.php"; ?>
	<h1>Classes</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Class</th>
								<th>Action</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php class_delete(); ?>
						<tbody>
							<?php
								$query = "SELECT * FROM class ORDER BY class ASC";
								$result = mysqli_query($conn, $query);
								if(!$result) {
									die(mysqli_error($conn));
								}
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>".$row['id']."</td>";
									echo "<td>Class ".$row['class']."</td>";
									echo "<td><a href='class.php?edit_class=".$row['id']."' class='btn btn-warning'>Edit</a></td>";
									echo "<td><a href='class.php?delete_class=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				<?php if(isset($_GET['edit_class'])) { ?>
				<div class="col-md-6">
					<?php
						update_class($_GET['edit_class']);
						$query2 = "SELECT class FROM class WHERE id=".$_GET['edit_class'];
						$result2 = mysqli_query($conn, $query2);
						$row = mysqli_fetch_assoc($result2);

					?>
					<form action="" method="post">
						<div class="form-group">
							<label for="">Update Class</label>
							<input type="number" name="class" class="form-control" value="<?php echo $row['class']; ?>">
						</div>
						<div class="form-group">
							<input type="submit" name="class_update_submit" value="Update Class" class="btn btn-warning">
							<a href="class.php" class="btn btn-info">Cancel</a>
						</div>
					</form>
				</div>
				<?php } else { ?>
				<div class="col-md-6">
					<?php add_class(); ?>
					<form action="" method="post">
						<div class="form-group">
							<label for="">Class</label>
							<input type="number" name="class" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" name="class_submit" value="Add Class" class="btn btn-info">
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
		</div>
<?php require_once "includes/footer.php"; ?>