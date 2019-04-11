<div class="col-md-12">
	<?php remove_assigned_teacher(); ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Info</th>
				<th>Subject</th>
				<th>Teacher</th>
				<th>Time</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = "SELECT *, class_teacher.id as class_id FROM class_teacher INNER JOIN user ON class_teacher.teacher_email=user.username ORDER BY class_teacher.id ASC";
				$result = mysqli_query($conn, $query);
				if(!$result) {
					die(mysqli_error($conn));
				}
				while ($row = mysqli_fetch_assoc($result)) {

					$global_name_id = $row['global_name_id'];
					$subject_id = $row['subject_name_id'];
					$query_global_name = "SELECT global_name FROM sections WHERE id=$global_name_id";
					$result_global_name = mysqli_query($conn, $query_global_name);
					$row_global_name = mysqli_fetch_assoc($result_global_name);
					$global_name = $row_global_name['global_name'];

					echo "<tr>";
					echo "<td>$global_name</td>";
					echo "<td>".get_subject_name_by_id($subject_id)."</td>";
					echo "<td>".$row['user_firstname'] ." ". $row['user_lastname']."</td>";
					echo "<td>".$row['class_time']."</td>";
					echo "<td><a href='assign_teacher.php?delete_class_teacher=".$row['class_id']."' class='btn btn-danger'>Delete</a></td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>