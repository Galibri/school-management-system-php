<table class="table table-centered table-bordered">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Designation</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$query = "SELECT * FROM teachers";
			$result = mysqli_query($conn, $query);
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row['id'];
				$teacher_email 			= $row['teacher_email'];
				$teacher_designation 	= $row['teacher_designation'];

				$query_2 = "SELECT * FROM user WHERE username='$teacher_email' LIMIT 1";
				$result_2 = mysqli_query($conn, $query_2);
				$row_2 = mysqli_fetch_assoc($result_2);

				$teacher_first_name = $row_2['user_firstname'];
				$teacher_last_name = $row_2['user_lastname'];

				echo "<tr>";
					echo "<td>$teacher_first_name</td>";
					echo "<td>$teacher_last_name</td>";
					echo "<td>$teacher_email</td>";
					echo "<td>$teacher_designation</td>";
					echo "<td><a class='btn btn-info' href='teachers.php?action=edit_teacher&t_id=$id'>Edit</a></td>";
					echo "<td><a class='btn btn-danger' href='teachers.php?action=delete_teacher&t_id=$id'>Delete</a></td>";
				echo "</tr>";
			}

		?>
	</tbody>
</table>