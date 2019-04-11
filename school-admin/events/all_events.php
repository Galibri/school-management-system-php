<table class="table table-centered table-bordered">
	<thead>
		<tr>
			<th>Events ID</th>
			<th>Events Title</th>
			<th>Events Description</th>
			<th>Events Image</th>
			<th>Events Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$query = "SELECT * FROM event";
			$result = mysqli_query($conn, $query);
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row['id'];
				$event_title = $row['event_title'];
				$event_desc = $row['event_desc'];
				$event_date = $row['event_date'];
				$event_image = $row['event_image'];
				$img_src = "../assets/images/event-images/{$event_image}";

				echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$event_title</td>";
					echo "<td>$event_desc</td>";
					echo "<td><img src='{$img_src}' width='70' height='40' ></td>";
					echo "<td>$event_date</td>";
					echo "<td><a class='btn btn-info' href='events.php?action=edit_event&e_id=$id'>Edit</a></td>";
					echo "<td><a class='btn btn-danger' href='events.php?action=delete_event&e_id=$id'>Delete</a></td>";
				echo "</tr>";
			}

		?>
	</tbody>
</table>