<?php
require_once '../functions.php';

if(isset($_POST['id'])) {
	$id = $_POST['id'];

	$select_class_time = "SELECT class_time FROM classtime WHERE id=$id";
	$class_time_res = mysqli_query($conn, $select_class_time);
	$class_time_row = mysqli_fetch_assoc($class_time_res);
	$class_time = $class_time_row['class_time'];

	$delete_assigned_sec_query = "DELETE FROM class_teacher WHERE class_time='$class_time'";
	$delete_assigned_sec_result = mysqli_query($conn, $delete_assigned_sec_query);

	$query = "DELETE FROM classtime WHERE id=$id";
	$result = mysqli_query($conn, $query);

	if($result) {
		return true;
	}
}