<?php

if(isset($_GET['action']) && $_GET['action'] == "delete_event") {

	$event_id = $_GET['e_id'];

	$query = "DELETE FROM event WHERE id=$event_id";
	$result = mysqli_query($conn,  $query);

	if($result) {
		header("Location: events.php");
	}
}