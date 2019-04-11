<div id="student-info">
	<table class="table table-centered table-bordered">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Class</th>
				<th>Section</th>
				<th>Group</th>
				<th>Roll</th>
				<th>Status</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php 

			//pagination
			 if (isset($_GET['pageno'])) {
	            $pageno = $_GET['pageno'];
	        } else {
	            $pageno = 1;
	        }
	        $no_of_records_per_page = 10;
	        $offset = ($pageno-1) * $no_of_records_per_page;

	        $total_pages_sql = "SELECT COUNT(*) FROM students";
	        $result = mysqli_query($conn,$total_pages_sql);
	        $total_rows = mysqli_fetch_array($result)[0];
	        $total_pages = ceil($total_rows / $no_of_records_per_page);


			//pagination
				$sql = "SELECT * FROM students LIMIT $offset, $no_of_records_per_page";
		        $res_data = mysqli_query($conn,$sql);

				while($row = mysqli_fetch_assoc($res_data)) {
					$id 					= $row['id'];
					$student_email 			= $row['student_email'];
					$student_class 			= $row['student_class'];
					$student_section 		= $row['student_section'];
					$student_group 			= $row['student_group'];
					$student_roll 			= $row['student_roll'];
					$student_status 		= $row['student_status'];

					$query_2 = "SELECT * FROM user WHERE username='$student_email' LIMIT 1";
					$result_2 = mysqli_query($conn, $query_2);
					$row_2 = mysqli_fetch_assoc($result_2);

					$student_first_name = $row_2['user_firstname'];
					$student_last_name = $row_2['user_lastname'];

					echo "<tr>";
						echo "<td>$student_first_name</td>";
						echo "<td>$student_last_name</td>";
						echo "<td>$student_email</td>";
						echo "<td>$student_class</td>";
						echo "<td>$student_section</td>";
						echo "<td>$student_group</td>";
						echo "<td>$student_roll</td>";
						echo "<td>$student_status</td>";
						echo "<td><a class='btn btn-info' href='students.php?action=edit_student&s_id=$id'>Edit</a></td>";
						echo "<td><a class='btn btn-danger' href='students.php?action=delete_student&s_id=$id'>Delete</a></td>";
					echo "</tr>";
				}

			?>
		</tbody>
	</table>
	<ul class="pagination pull-right">
	    <li><a href="?pageno=1">First</a></li>
	    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
	        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
	    </li>

	    <?php for($i = 1; $i <= $total_pages; $i++) { ?>
	    <li>
	        <a href="<?php echo "?pageno=".$i; ?>"><?php echo $i; ?></a>
	    </li>
	     <?php } ?>

	    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
	        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
	    </li>
	    <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
	</ul>
</div>

<script>
	$(document).ready(function() {
		$("#search-students").on('keyup', function() {
			var search_value = $(this).val();
			if(search_value != '') {
				$.ajax({
					url: 'students/search_student_process.php',
					type: 'POST',
					data: {search_value: search_value},
					success: function(data){
						$("#student-info").html(data);
					}
				});
			} else {
				location.reload();
			}
		});
	});
</script>