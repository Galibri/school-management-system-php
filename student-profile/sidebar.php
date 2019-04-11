<div class="panel panel-success">
	<div class="panel-heading"><h3>Links</h3></div>
	<div class="panel-body">
		<ul class="student-side-menu">
			<li><a href="my_result.php">Result</a></li>
			<li><a href="submit_problem.php">Submit Problem</a></li>
			<li><a href="my_routine.php">Routine</a></li>
		</ul>
	</div>
</div>
<div class="notice-block">
	<div class="panel panel-success">
	<div class="panel-heading"><h3>NOTICES</h3></div>
	<div class="panel-body">
	<?php 
		$query = "SELECT * FROM notice ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_assoc($result)) {
			$notice_id = $row['id'];
			$notice_title = $row['notice_title'];
			echo "<p><i class='fa fa-hand-o-right'><a href='../notice.php?id=$notice_id' target='_blank'>$notice_title</a></i></p>";
		}
	?>
	</div>
	</div>
</div>