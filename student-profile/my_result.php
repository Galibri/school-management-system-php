<?php require_once "includes/header.php"; ?>

<?php
	$username = $_SESSION['username'];

	$select_student = "SELECT * FROM students WHERE student_email='$username'";
	$student_result = mysqli_query($conn, $select_student);
	$student = mysqli_fetch_assoc($student_result);

	$student_email = $student['student_email'];
	$student_name = $student['student_name'];
	$student_class = $student['student_class'];
	$student_section = $student['student_section'];
	$student_group = $student['student_group'];
	$student_roll = $student['student_roll'];
	$student_father_name = $student['student_father_name'];
	$student_mother_name = $student['student_mother_name'];
	$student_address = $student['student_address'];
	$student_contact = $student['student_contact'];
	$student_dob = $student['student_dob'];
	$student_blood_group = $student['student_blood_group'];
	$student_gender = $student['student_gender'];
	$student_status = $student['student_status'];

	
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">Classes</div>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#6a" data-toggle="tab">Class 6 (Mid)</a></li>
				<li><a href="#6b" data-toggle="tab">Class 6 (Final)</a></li>
				<li><a href="#7a" data-toggle="tab">Class 7 (Mid)</a></li>
				<li><a href="#7b" data-toggle="tab">Class 7 (Final)</a></li>
				<li><a href="#8a" data-toggle="tab">Class 8 (Mid)</a></li>
				<li><a href="#8b" data-toggle="tab">Class 8 (Test)</a></li>
				<li><a href="#9a" data-toggle="tab">Class 9 (Mid)</a></li>
				<li><a href="#9b" data-toggle="tab">Class 9 (Final)</a></li>
				<li><a href="#10a" data-toggle="tab">Class 10 (Pre Test)</a></li>
				<li><a href="#10b" data-toggle="tab">Class 10 (Test)</a></li>
			</ul>
			</div>
		</div>
		<div class="col-md-8">
		<div class="tab-content clearfix" id="printTable">
			<div class="panel panel-info tab-pane active" id="6a">
				<div class="panel-heading">Class 06 (Mid)</div>
				<table class="table table-striped" id="PrintClass6">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_6_mid = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=6 AND results.exam_type='mid'";

						$result_6_mid = mysqli_query($conn, $query_6_mid);
						if(!$result_6_mid) {
							die(mysqli_error($conn));
						} else {
							while($row_6_mid = mysqli_fetch_assoc($result_6_mid)) {
								$myMarks = $row_6_mid['marks'];
								$grade = $row_6_mid['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;

								echo "<tr>";
								echo "<td>". $row_6_mid['subject'] ."</td>";
								echo "<td>". $row_6_mid['marks'] ."</td>";
								echo "<td>". $row_6_mid['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
				<button onclick='printDiv("PrintClass6")' class="btn btn-info pull-right">Print</button>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="6b">
				<div class="panel-heading">Class 06 (Final)</div>
				<table class="table table-striped" id="PrintClass6final">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_6_final = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=6 AND results.exam_type='final'";

						$result_6_final = mysqli_query($conn, $query_6_final);
						if(!$result_6_final) {
							die(mysqli_error($conn));
						} else {
							while($row_6_final = mysqli_fetch_assoc($result_6_final)) {
								$myMarks = $row_6_final['marks'];
								$grade = $row_6_final['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;

								echo "<tr>";
								echo "<td>". $row_6_final['subject'] ."</td>";
								echo "<td>". $row_6_final['marks'] ."</td>";
								echo "<td>". $row_6_final['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
				<button onclick='printDiv("PrintClass6final")' class="btn btn-info pull-right">Print</button>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="7a">
				<div class="panel-heading">Class 07 (Mid)</div>
				<table class="table table-striped" id="PrintClass7mid">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_7_mid = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=7 AND results.exam_type='mid'";

						$result_7_mid = mysqli_query($conn, $query_7_mid);
						if(!$result_7_mid) {
							die(mysqli_error($conn));
						} else {
							while($row_7_mid = mysqli_fetch_assoc($result_7_mid)) {
								$myMarks = $row_7_mid['marks'];
								$grade = $row_7_mid['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_7_mid['subject'] ."</td>";
								echo "<td>". $row_7_mid['marks'] ."</td>";
								echo "<td>". $row_7_mid['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
				<button onclick='printDiv("PrintClass7mid")' class="btn btn-info pull-right">Print</button>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="7b">
				<div class="panel-heading">Class 07 (Final)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_7_final = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=7 AND results.exam_type='final'";

						$result_7_final = mysqli_query($conn, $query_7_final);
						if(!$result_7_final) {
							die(mysqli_error($conn));
						} else {
							while($row_7_final = mysqli_fetch_assoc($result_7_final)) {
								$myMarks = $row_7_final['marks'];
								$grade = $row_7_final['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_7_final['subject'] ."</td>";
								echo "<td>". $row_7_final['marks'] ."</td>";
								echo "<td>". $row_7_final['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="8a">
				<div class="panel-heading">Class 08 (Mid)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_8_mid = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=8 AND results.exam_type='mid'";

						$result_8_mid = mysqli_query($conn, $query_8_mid);
						if(!$result_8_mid) {
							die(mysqli_error($conn));
						} else {
							while($row_8_mid = mysqli_fetch_assoc($result_8_mid)) {
								$myMarks = $row_8_mid['marks'];
								$grade = $row_8_mid['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_8_mid['subject'] ."</td>";
								echo "<td>". $row_8_mid['marks'] ."</td>";
								echo "<td>". $row_8_mid['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="8b">
				<div class="panel-heading">Class 08 (Final Test)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_8_final = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=8 AND results.exam_type='final'";

						$result_8_final = mysqli_query($conn, $query_8_final);
						if(!$result_8_final) {
							die(mysqli_error($conn));
						} else {
							while($row_8_final = mysqli_fetch_assoc($result_8_final)) {
								$myMarks = $row_8_final['marks'];
								$grade = $row_8_final['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_8_final['subject'] ."</td>";
								echo "<td>". $row_8_final['marks'] ."</td>";
								echo "<td>". $row_8_final['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="9a">
				<div class="panel-heading">Class 09 (Mid)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_9_mid = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=9 AND results.exam_type='mid'";

						$result_9_mid = mysqli_query($conn, $query_9_mid);
						if(!$result_9_mid) {
							die(mysqli_error($conn));
						} else {
							while($row_9_mid = mysqli_fetch_assoc($result_9_mid)) {
								$myMarks = $row_9_mid['marks'];
								$grade = $row_9_mid['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_9_mid['subject'] ."</td>";
								echo "<td>". $row_9_mid['marks'] ."</td>";
								echo "<td>". $row_9_mid['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="9b">
				<div class="panel-heading">Class 09 (Final)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_9_final = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=9 AND results.exam_type='final'";

						$result_9_final = mysqli_query($conn, $query_9_final);
						if(!$result_9_final) {
							die(mysqli_error($conn));
						} else {
							while($row_9_final = mysqli_fetch_assoc($result_9_final)) {
								$myMarks = $row_9_final['marks'];
								$grade = $row_9_final['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_9_final['subject'] ."</td>";
								echo "<td>". $row_9_final['marks'] ."</td>";
								echo "<td>". $row_9_final['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="10a">
				<div class="panel-heading">Class 10 (Pre Test)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_10_mid = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=10 AND results.exam_type='mid'";

						$result_10_mid = mysqli_query($conn, $query_10_mid);
						if(!$result_10_mid) {
							die(mysqli_error($conn));
						} else {
							while($row_10_mid = mysqli_fetch_assoc($result_10_mid)) {
								$myMarks = $row_10_mid['marks'];
								$grade = $row_10_mid['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_10_mid['subject'] ."</td>";
								echo "<td>". $row_10_mid['marks'] ."</td>";
								echo "<td>". $row_10_mid['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
			<div class="panel panel-info tab-pane" id="10b">
				<div class="panel-heading">Class 10 (Final Test)</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Subject</th>
							<th>Marks</th>
							<th>Grade</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$totalMarks = 0;
						$totalGrades = 0;
						$totalSubjects = 0;
						$query_10_final = "SELECT results.*, subjects.subject FROM results INNER JOIN subjects ON results.subject_id=subjects.id WHERE results.student_id='$username' AND results.student_class=10 AND results.exam_type='final'";

						$result_10_final = mysqli_query($conn, $query_10_final);
						if(!$result_10_final) {
							die(mysqli_error($conn));
						} else {
							while($row_10_final = mysqli_fetch_assoc($result_10_final)) {
								$myMarks = $row_10_final['marks'];
								$grade = $row_10_final['grade'];

								$totalMarks = $totalMarks + $myMarks;
								$totalGrades = $totalGrades + $grade;
								$totalSubjects++;
								
								echo "<tr>";
								echo "<td>". $row_10_final['subject'] ."</td>";
								echo "<td>". $row_10_final['marks'] ."</td>";
								echo "<td>". $row_10_final['grade'] ."</td>";
								echo "</tr>";
							}
						}
					?>
					<tr>
						<th>Total</th>
						<th><?php echo $totalMarks; ?></th>
						<th><?php echo final_grading_point($totalGrades, $totalSubjects); ?></th>
					</tr>
					</tbody>
				</table>
			</div> <!-- panel -->
		</div>
		</div>
	</div>
</div>

<?php require_once "includes/footer.php"; ?>