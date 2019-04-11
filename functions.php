<?php
require_once "includes/db.php";
session_start();
date_default_timezone_set('Asia/Dhaka');

/*****************************
@ Global Functions
******************************/
function clean_data( $data ) {
	global $conn;
	$cleaned_data = mysqli_real_escape_string($conn, trim($data));

	return $cleaned_data;
}

/*****************************
@ Notices
******************************/
//add new notice from dashboard
function add_new_notice() {
	global $conn;
	if(isset($_POST['add_notice_btn'])) {
		$notice_title = clean_data($_POST['notice_title']);
		$notice_desc = clean_data($_POST['notice_desc']);

		if(!empty($notice_title) && !empty($notice_desc)) {
			$query = "INSERT INTO notice (notice_title, notice_desc, notice_date) VALUES ('$notice_title', '$notice_desc', now())";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die("Error." . mysqli_error($conn));
			} else {
				header("Location: notices.php?action=add_new&message=success");
			}

		}
	}
}

//show notice data in dashboard
function showNoticeData() {
	$notice = [];
	global $conn;
	if(isset($_GET['action']) && $_GET['action'] == "edit_notice") {
		$get_the_id = $_GET['n_id'];
		$query = "SELECT * FROM notice WHERE id=$get_the_id";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$notice['notice_title'] = $row['notice_title'];
			$notice['notice_desc'] = $row['notice_desc'];
		}
	}
	return $notice;
}

//update notice from dashboard
function update_notice() {
	global $conn;
	$get_the_id = $_GET['n_id'];
	if(isset($_POST['update_notice_btn'])) {
		$notice_title = clean_data($_POST['notice_title']);
		$notice_desc = clean_data($_POST['notice_desc']);

		if(!empty($notice_title) && !empty($notice_desc)) {
			$query = "UPDATE notice SET notice_title='$notice_title', notice_desc='$notice_desc', notice_date=now() WHERE id=$get_the_id";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die("Error." . mysqli_error($conn));
			} else {
				header("Location: notices.php?action=edit_notice&n_id=$get_the_id&message=success");
			}

		}
	}
}


/*****************************
@ Events
******************************/
//add new event from dashboard
function add_new_event() {
	global $conn;
	if(isset($_POST['add_event_btn'])) {
		$event_title = clean_data($_POST['event_title']);
		$event_desc = clean_data($_POST['event_desc']);
		$event_image = $_FILES['event_image']['name'];
		$event_image_tmp = $_FILES['event_image']['tmp_name'];

		$path = "../assets/images/event-images/{$event_image}";

		move_uploaded_file($event_image_tmp, $path);

		if(!empty($event_title)) {
			$query = "INSERT INTO event (event_title, event_desc, event_image, event_date) VALUES ('$event_title', '$event_desc', '$event_image', now())";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die("Error." . mysqli_error($conn));
			} else {
				header("Location: events.php?action=add_new&message=success");
			}

		}
	}
}

//show event data in dashboard
function showEventData() {
	$event = [];
	global $conn;
	if(isset($_GET['action']) && $_GET['action'] == "edit_event") {
		$get_the_id = $_GET['e_id'];
		$query = "SELECT * FROM event WHERE id=$get_the_id";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$event['event_title'] = $row['event_title'];
			$event['event_desc'] = $row['event_desc'];
			$event['event_image'] = $row['event_image'];
		}
	}
	return $event;
}

//update event from dashboard
function update_event() {
	global $conn;
	$get_the_id = $_GET['e_id'];
	if(isset($_POST['update_event_btn'])) {
		$event_title = clean_data($_POST['event_title']);
		$event_desc = clean_data($_POST['event_desc']);

		$event_image = $_FILES['event_image']['name'];
		$event_image_tmp = $_FILES['event_image']['tmp_name'];

		$path = "../assets/images/event-images/{$event_image}";

		if(!empty($event_image)) {
			move_uploaded_file($event_image_tmp, $path);
			$query_image = "UPDATE event SET event_image='$event_image' WHERE id=$get_the_id";
			$result_image = mysqli_query($conn, $query_image);
		}

		if(!empty($event_title) && !empty($event_desc)) {
			$query = "UPDATE event SET event_title='$event_title', event_desc='$event_desc', event_date=now() WHERE id=$get_the_id";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die("Error." . mysqli_error($conn));
			} else {
				header("Location: events.php?action=edit_event&e_id=$get_the_id&message=success");
			}
		}
	}
}


/*****************************
@ Login
******************************/
//login system
function user_login() {
	global $conn;
	$error = '';

	if(isset($_POST['user_login'])) {
		$username 		= $_POST['username'];
		$user_password 	= $_POST['user_password'];
		$user_role 		= $_POST['user_role'];

		if(!empty($username) && !empty($user_password) && !empty($user_role)) {
			$query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die("Can't login." . mysqli_error($conn));
			}
			$row = mysqli_fetch_assoc($result);
			$id 				= $row['id'];
			$db_username 		= $row['username'];
			$db_user_password 	= $row['user_password'];
			$db_user_role 		= $row['user_role'];
			if($username == $db_username && $user_password == $db_user_password && $user_role == $db_user_role) {
				$_SESSION['username'] = $db_username;
				$_SESSION['user_role'] = $db_user_role;
				$_SESSION['id'] = $id;
				if($db_user_role == 'administrator') {
					header("Location: school-admin/index.php");
				} elseif($db_user_role == 'student') {
					header("Location: student-profile/index.php");
				} elseif($db_user_role == 'teacher') {
					header("Location: teacher-dashboard/index.php");
				} elseif($db_user_role == 'controller') {
					header("Location: controller/index.php");
				} elseif($db_user_role == 'librarian') {
					header("Location: librarian/index.php");
				}
			} else {
				$error = "Credentials did not match. Please enter your correct username and password.";
			}
		} else {
			$error = "Fields can't be empty.";
		}
	}
	return $error;
}

// if user logged in
function is_user_logged_in() {
	if(isset($_SESSION['user_role'])) {
		return true;
	} else {
		return false;
	}
}

// if admin
function is_admin() {
	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "administrator") {
		return true;
	} else {
		return false;
	}
}

// if student
function is_student() {
	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "student") {
		return true;
	} else {
		return false;
	}
}

// if teacher
function is_teacher() {
	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "teacher") {
		return true;
	} else {
		return false;
	}
}

// if controller
function is_controller() {
	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "controller") {
		return true;
	} else {
		return false;
	}
}

// if librarian
function is_librarian() {
	if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "librarian") {
		return true;
	} else {
		return false;
	}
}

// get name by session
function get_name_by_session() {
	global $conn;
	$fullName = '';
	if(isset($_SESSION['username'])) {
		$session_user = $_SESSION['username'];
		$query = "SELECT user_firstname, user_lastname FROM user WHERE username='$session_user' LIMIT 1";
		$result = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($result);

		$first_name = $row['user_firstname'];
		$last_name = $row['user_lastname'];

		$fullName = $first_name . " " . $last_name;
	}
	return $fullName;
}

function get_name_by_email($email) {
	global $conn;
	$query = "SELECT user_firstname, user_lastname FROM user WHERE username='$email'";
	$result = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($result);

	return $row['user_firstname']. " " .$row['user_lastname'];
}

function get_students_of_teacher($global_name_id, $dates) {
	global $conn;
	$total_students = [];
	$select_students = "SELECT attendance.student_id, students.student_roll  FROM attendance INNER JOIN students ON attendance.student_id=students.student_email WHERE attendance.global_name_id=$global_name_id AND attendance.dates='$dates' ORDER BY students.student_roll";
	$students_result = mysqli_query($conn, $select_students);
	while($row = mysqli_fetch_assoc($students_result)) {
		$total_students[] = $row['student_id'];
	}
	return $total_students;
}

function get_attendance_total_students($teacher_email, $global_name_id, $exam_type){
	global $conn;
	$total_students = [];
	$query = "SELECT * FROM results WHERE teacher_email='$teacher_email' AND global_name_id='$global_name_id' AND exam_type='$exam_type' ORDER BY student_roll ASC";

	$results = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($results)) {
		$total_students[] = $row['student_id'];
	}
	return $total_students;
}

/*****************************
@ Teacher functions
******************************/
//register teacher by admin
function register_teacher() {
	global $conn;
	$error = "";
	if(isset($_POST['add_teacher_btn'])) {
		$first_name 			= clean_data($_POST['teacher_first_name']);
		$last_name 				= clean_data($_POST['teacher_last_name']);
		$teacher_designation 	= clean_data($_POST['teacher_designation']);
		$teacher_gender 		= clean_data($_POST['teacher_gender']);
		$teacher_email 			= clean_data($_POST['teacher_email']);
		$teacher_qualification 	= clean_data($_POST['teacher_qualification']);
		$teacher_address 		= clean_data($_POST['teacher_address']);
		$teacher_contact 		= clean_data($_POST['teacher_contact']);
		$password 				= clean_data($_POST['password']);
		$teacher_img_name 		= $_FILES['teacher_image']['name'];
		$teacher_img_tmp_name 	= $_FILES['teacher_image']['tmp_name'];

		if(!empty($first_name) && !empty($last_name) && !empty($teacher_designation) && !empty($teacher_email) && !empty($teacher_qualification) && !empty($teacher_address) && !empty($teacher_contact) && !empty($password) && !empty($teacher_img_name)) {

			$path = "../assets/images/teacher-images/{$teacher_img_name}";

			move_uploaded_file($teacher_img_tmp_name, $path);

			if(is_user_unique($teacher_email)) {
				$query = "INSERT INTO user(username, user_password, user_role, user_firstname, user_lastname) VALUES('$teacher_email', '$password', 'teacher', '$first_name', '$last_name')";
				$result = mysqli_query($conn, $query);

				$query_2 = "INSERT INTO teachers(teacher_designation, teacher_gender, teacher_qualification, teacher_email, teacher_address, teacher_contact, teacher_image) VALUES('$teacher_designation', '$teacher_gender', '$teacher_qualification', '$teacher_email', '$teacher_address', '$teacher_contact', '$teacher_img_name')";
				$result_2 = mysqli_query($conn, $query_2);

				header("Location: teachers.php?action=add_new&message=success");
			} else {
				$error = "This email already exists. Email must be unique.";
			}
		} else {
			$error = "Fields can't be empty.";
		}
	}
	return $error;
}

// is user unique
function is_user_unique( $username ) {
	global $conn;
	$query = "SELECT * FROM user WHERE username='$username'";
	$result = mysqli_query($conn, $query);
	$have_result = mysqli_num_rows($result);
	if($have_result <= 0) {
		return true;
	} else {
		return false;
	}
}

//show teachers in Edit field
function showTeachersData() {
	global $conn;
	$data = [];
	if(isset($_GET['action']) && $_GET['action'] == "edit_teacher") {
		$id = $_GET['t_id'];
		$query = "SELECT * FROM teachers WHERE id=$id LIMIT 1";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		$data['teacher_designation'] 	= $row['teacher_designation'];
		$data['teacher_gender'] 		= $row['teacher_gender'];
		$data['teacher_image'] 			= $row['teacher_image'];
		$data['teacher_qualification'] 	= $row['teacher_qualification'];
		$data['teacher_email'] 			= $row['teacher_email'];
		$data['teacher_address'] 		= $row['teacher_address'];
		$data['teacher_contact'] 		= $row['teacher_contact'];
		$teacher_email 					= $data['teacher_email'];

		$query_2 = "SELECT * FROM user WHERE username='$teacher_email' LIMIT 1";
		$result_2 = mysqli_query($conn, $query_2);
		$row_2 = mysqli_fetch_assoc($result_2);

		$data['teacher_first_name'] = $row_2['user_firstname'];
		$data['teacher_last_name'] = $row_2['user_lastname'];

	}
	return $data;
}

// update teacher by id
function updateTeacherById() {
	global $conn;
	if(isset($_GET['t_id'])) {

		$t_id = $_GET['t_id'];

		if(isset($_POST['update_teacher_btn'])) {
			$first_name 			= clean_data($_POST['teacher_first_name']);
			$last_name 				= clean_data($_POST['teacher_last_name']);
			$teacher_designation 	= clean_data($_POST['teacher_designation']);
			$teacher_gender 		= clean_data($_POST['teacher_gender']);
			$teacher_qualification 	= clean_data($_POST['teacher_qualification']);
			$teacher_address 		= clean_data($_POST['teacher_address']);
			$teacher_contact 		= clean_data($_POST['teacher_contact']);
			$password 				= clean_data($_POST['password']);
			$teacher_img_name 		= $_FILES['teacher_image']['name'];
			$teacher_img_tmp_name 	= $_FILES['teacher_image']['tmp_name'];

			$teacher_email = teacher_email_by_id($t_id);

			if(!empty($teacher_img_name)) {
				$path = "../assets/images/teacher-images/{$teacher_img_name}";
				move_uploaded_file($teacher_img_tmp_name, $path);

				$query_img = "UPDATE teachers SET teacher_image='$teacher_img_name' WHERE id='$t_id'";
				$result_img = mysqli_query($conn, $query_img);
				if(!$result_img) {
					die(mysqli_error($conn));
				}

			}

			if(!empty($first_name) && !empty($last_name)) {
				$query = "UPDATE user SET user_firstname='$first_name', user_lastname='$last_name' WHERE username='$teacher_email'";
				$result = mysqli_query($conn, $query);
				if(!$result) {
					die(mysqli_error($conn));
				}
			}
			if(!empty($password)) {
				$query_2 = "UPDATE user SET user_password='$password' WHERE username='$teacher_email'";
				$result_2 = mysqli_query($conn, $query_2);
			}
			if(!empty($teacher_designation) && !empty($teacher_qualification) && !empty($teacher_address) && !empty($teacher_contact)) {
				$query_3 = "UPDATE teachers SET teacher_designation='$teacher_designation', teacher_gender='$teacher_gender', teacher_qualification='$teacher_qualification', teacher_address='$teacher_address', teacher_contact='$teacher_contact' WHERE id=$t_id";
				$result_3 = mysqli_query($conn, $query_3);
			}
			header("Location: teachers.php?action=edit_teacher&t_id=$t_id&message=success");
		}
	}
}

//get teacher email by teacher id

function teacher_email_by_id($id) {
	global $conn;
	$query = "SELECT teacher_email FROM teachers WHERE id=$id LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	return $row['teacher_email'];
}

function teacher_name_by_email($email) {
	global $conn;
	$query = "SELECT user_firstname, user_lastname FROM user WHERE username='$email' LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	return $row['user_firstname']. " " . $row['user_lastname'];
}



/*****************************
@ Students functions
******************************/
//register teacher by admin
function register_student() {
	global $conn;
	$error = "";
	if(isset($_POST['add_student_btn'])) {
		$first_name 			= clean_data($_POST['user_firstname']);
		$last_name 				= clean_data($_POST['user_lastname']);
		$student_email 			= clean_data($_POST['username']);
		$password 				= clean_data($_POST['user_password']);
		$student_class		 	= clean_data($_POST['student_class']);
		$student_section	 	= clean_data($_POST['student_section']);
		$student_group		 	= clean_data($_POST['student_group']);
		$student_roll	 		= clean_data($_POST['student_roll']);
		$student_father_name 	= clean_data($_POST['student_father_name']);
		$student_mother_name 	= clean_data($_POST['student_mother_name']);
		$student_address	 	= clean_data($_POST['student_address']);
		$student_contact	 	= clean_data($_POST['student_contact']);
		$student_dob		 	= clean_data($_POST['student_dob']);
		$student_blood_group	= clean_data($_POST['student_blood_group']);
		$student_gender			= clean_data($_POST['student_gender']);
		$student_status			= clean_data($_POST['student_status']);
		$student_name 			= $first_name. " ". $last_name;

		if(!empty($first_name) && !empty($last_name) && !empty($student_email) && !empty($password) && !empty($student_class) && !empty($student_roll) && !empty($student_address) && !empty($student_contact)) {
			if(is_user_unique($student_email)) {
				$query = "INSERT INTO user(username, user_password, user_role, user_firstname, user_lastname) VALUES('$student_email', '$password', 'student', '$first_name', '$last_name')";
				$result = mysqli_query($conn, $query);

				$query_2 = "INSERT INTO students(student_email, student_name, student_class, student_section, student_group, student_roll, student_father_name, student_mother_name, student_address, student_contact, student_dob, student_blood_group, student_gender, student_status) VALUES('$student_email', '$student_name', '$student_class', '$student_section', '$student_group', '$student_roll', '$student_father_name', '$student_mother_name', '$student_address', '$student_contact', '$student_dob', '$student_blood_group', '$student_gender', '$student_status')";
				$result_2 = mysqli_query($conn, $query_2);
				if(!$result_2) {
					die(mysqli_error($conn));
				}

				header("Location: students.php?action=add_new&message=success");
			} else {
				$error = "This email already exists. Email must be unique.";
			}
		} else {
			$error = "Fields can't be empty.";
		}
	}
	return $error;
}

//show teachers in Edit field
function showStudentsData() {
	global $conn;
	$data = [];
	if(isset($_GET['action']) && $_GET['action']=='edit_student') {
		$s_id = $_GET['s_id'];
		$query = "SELECT * FROM students INNER JOIN user ON user.username=students.student_email AND students.id=$s_id";
		$result = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($result);
		$data['username'] = $row['username'];
		$data['user_role'] = $row['user_role'];
		$data['user_firstname'] = $row['user_firstname'];
		$data['user_lastname'] = $row['user_lastname'];
		$data['student_class'] = $row['student_class'];
		$data['student_section'] = $row['student_section'];
		$data['student_roll'] = $row['student_roll'];
		$data['student_father_name'] = $row['student_father_name'];
		$data['student_mother_name'] = $row['student_mother_name'];
		$data['student_address'] = $row['student_address'];
		$data['student_contact'] = $row['student_contact'];
		$data['student_dob']		 	= $row['student_dob'];
		$data['student_blood_group']	= $row['student_blood_group'];
		$data['student_gender']			= $row['student_gender'];
		$data['student_status']			= $row['student_status'];

	}
	
	return $data;
}	

// update students by id
function updateStudentById() {
	global $conn;
	$s_id = $_GET['s_id'];
	if(isset($_POST['update_student_btn'])) {
		$username 				= clean_data($_POST['username']);
		$user_role 				= clean_data($_POST['user_role']);
		$user_password 			= clean_data($_POST['user_password']);
		$user_firstname 		= clean_data($_POST['user_firstname']);
		$user_lastname 			= clean_data($_POST['user_lastname']);
		$student_class 			= clean_data($_POST['student_class']);
		$student_section 		= clean_data($_POST['student_section']);
		$student_group 			= clean_data($_POST['student_group']);
		$student_roll 			= clean_data($_POST['student_roll']);
		$student_father_name 	= clean_data($_POST['student_father_name']);
		$student_mother_name 	= clean_data($_POST['student_mother_name']);
		$student_address 		= clean_data($_POST['student_address']);
		$student_contact 		= clean_data($_POST['student_contact']);
		$student_dob		 	= clean_data($_POST['student_dob']);
		$student_blood_group	= clean_data($_POST['student_blood_group']);
		$student_gender			= clean_data($_POST['student_gender']);
		$student_status			= clean_data($_POST['student_status']);
		$student_name 			= $user_firstname. " ". $user_lastname;

		$student_email = student_email_by_id($s_id);

		if(!empty($user_firstname) && !empty($user_lastname) && !empty($username)) {
			$query = "UPDATE user SET user_firstname='$user_firstname', user_lastname='$user_lastname', username='$username' WHERE username='$student_email'";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die(mysqli_error($conn));
			}
		}
		if(!empty($user_password)) {
			$query_2 = "UPDATE user SET user_password='$user_password' WHERE username='$student_email'";
			$result_2 = mysqli_query($conn, $query_2);
		}
		if(!empty($student_section) && !empty($student_roll) && !empty($student_address) && !empty($student_contact) && !empty($student_class)) {
			$query_3 = "UPDATE students SET student_email='$username', student_name='$student_name', student_class='$student_class', student_section='$student_section', student_group='$student_group', student_roll='$student_roll', student_father_name='$student_father_name', student_mother_name='$student_mother_name', student_address='$student_address', student_contact='$student_contact', student_dob='$student_dob', student_blood_group='$student_blood_group', student_gender='$student_gender', student_status='$student_status' WHERE id=$s_id";
			$result_3 = mysqli_query($conn, $query_3);
		}
		header("Location: students.php?action=edit_student&s_id=$s_id&message=success");
	}
}

//get teacher email by teacher id

function student_email_by_id($id) {
	global $conn;
	$query = "SELECT student_email FROM students WHERE id=$id LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	return $row['student_email'];
}


/**************************************
@ Classes / Sections / Subjects
***************************************/

function add_class() {
	global $conn;
	if(isset($_POST['class_submit'])) {
		$class = clean_data($_POST['class']);
		if(!empty($class)) {
			$query = "INSERT INTO class (class) VALUES ('$class')";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: class.php");
			}
		}
	}
}

function update_class($id) {
	global $conn;
	if(isset($_POST['class_update_submit'])) {
		$class = clean_data($_POST['class']);
		if(!empty($class)) {
			$query = "UPDATE class SET class='$class' WHERE id='$id'";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: class.php");
			}
		}
	}
}

function add_section() {
	global $conn;
	if(isset($_POST['section_submit'])) {
		$class_id = $_POST['class_id'];
		$section = clean_data($_POST['section']);
		$group_name = clean_data($_POST['group_name']);

		$grp_available = empty($group_name) ? '' : " | Group: ".$group_name;

		$global_name = "Class: {$class_id} | Section: $section $grp_available";
		if(!empty($class_id) && !empty($section)) {
			$query = "INSERT INTO sections (class_id, section, group_name, global_name) VALUES ('$class_id', '$section', '$group_name', '$global_name')";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: sections.php");
			} else {
				die(mysqli_error($conn));
			}
		}
	}
}

function delete_section() {
	global $conn;
	if(isset($_GET['delete_section'])) {
		$id = $_GET['delete_section'];

		$class= get_class_by_global_id($id);
		$student_section = get_section_by_global_id($id);
		$student_group = get_group_by_global_id($id);

		$delete_class_query = "DELETE FROM students WHERE student_class=$class AND student_section='$student_section' AND student_group='$student_group'";
		$delete_class_result = mysqli_query($conn, $delete_class_query);

		$del_techer_query = "DELETE FROM class_teacher WHERE global_name_id=$id";
		$del_teacher_result = mysqli_query($conn, $del_techer_query);

		$query2 = "DELETE FROM sections WHERE id=$id";
		$result = mysqli_query($conn, $query2);
		if($result) {
			header("Location: sections.php");
		} else {
			die(mysqli_error($conn));
		}
	}
}


function get_class_by_global_id($global_id) {
	global $conn;
	$query = "SELECT class_id FROM sections WHERE id=$global_id";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	return $data['class_id'];
}

function get_section_by_global_id($global_id) {
	global $conn;
	$query = "SELECT section FROM sections WHERE id=$global_id";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	return $data['section'];
}

function get_group_by_global_id($global_id) {
	global $conn;
	$query = "SELECT group_name FROM sections WHERE id=$global_id";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	return $data['group_name'];
}

function class_delete() {
	global $conn;
	if(isset($_GET['delete_class'])) {
		$id = $_GET['delete_class'];
		$class = get_class_by_id($id);
		$section_id = get_global_name_id_by_id($class);

		$delete_section_query = "DELETE FROM sections WHERE class_id=$id";
		$delete_section_result = mysqli_query($conn, $delete_section_query);

		$delete_class_query = "DELETE FROM students WHERE student_class=$class";
		$delete_class_result = mysqli_query($conn, $delete_class_query);

		$delete_assigned_sec_query = "DELETE FROM class_teacher WHERE global_name_id=$section_id";
		$delete_assigned_sec_result = mysqli_query($conn, $delete_assigned_sec_query);

		
		$query = "DELETE FROM class WHERE id=$id";
		$result = mysqli_query($conn, $query);
		if($result) {
			header("Location: class.php");
		}

	}
}

function get_class_by_id($class_id) {
	global $conn;
	$query = "SELECT class FROM class WHERE id=$class_id";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	return $data['class'];
}

function get_global_name_id_by_id($class) {
	global $conn;
	$query = "SELECT id FROM sections WHERE class_id=$class";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_assoc($result);
	return $data['id'];
}

function add_subject() {
	global $conn;
	if(isset($_POST['subject_submit'])) {
		$subject = clean_data($_POST['subject']);
		if(!empty($subject)) {
			$query = "INSERT INTO subjects (subject) VALUES ('$subject')";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: subjects.php");
			} else {
				die(mysqli_error($conn));
			}
		}
	}
}

function update_subject($id) {
	global $conn;
	if(isset($_POST['subject_update_submit'])) {
		$subject = clean_data($_POST['subject']);
		if(!empty($subject)) {
			$query = "UPDATE subjects SET subject='$subject' WHERE id=$id";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: subjects.php");
			} else {
				die(mysqli_error($conn));
			}
		}
	}
}

function delete_subject() {
	global $conn;
	if(isset($_GET['delete_subject'])) {
		$id = $_GET['delete_subject'];

		$sub_query = "DELETE FROM class_teacher WHERE class_name_id=$id";
		$delete_sub = mysqli_query($conn, $sub_query);
		
		$query = "DELETE FROM subjects WHERE id=$id";
		$result = mysqli_query($conn, $query);
		if($result) {
			header("Location: subjects.php");
		}

	}
}

function get_subject_name_by_id($id) {
	global $conn;
	$query = "SELECT subject FROM subjects WHERE id=$id";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	return $row['subject'];
}



//class time

function add_class_time() {
	global $conn;
	if(isset($_POST['class_time_submit'])) {
		$class_time = clean_data($_POST['class_time']);
		if(!empty($class_time)) {
			$query = "INSERT INTO classtime (class_time) VALUES ('$class_time')";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: class_time.php");
			} else {
				die(mysqli_error($conn));
			}
		}
	}
}

function update_class_time($id) {
	global $conn;
	if(isset($_POST['update_class_time_submit'])) {
		$class_time = clean_data($_POST['class_time']);
		if(!empty($class_time)) {
			$query = "UPDATE classtime SET class_time='$class_time' WHERE id=$id";
			$result = mysqli_query($conn, $query);
			if($result) {
				header("Location: class_time.php");
			} else {
				die(mysqli_error($conn));
			}
		}
	}
}

//deprecated
function delete_class_time($id) {
	global $conn;
	$query = "DELETE FROM classtime WHERE id=$id";
	$result = mysqli_query($conn, $query);
	if($result) {
		header("Location: class_time.php");
	}
}

function get_class_time_by_id($id) {
	global $conn;
	$query = "SELECT class_time FROM classtime WHERE id=$id";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	return $row['class_time'];
}


//admin function
// select teacher for class

//assign teacher to class
// class_teacher: id, class_id, section_id, group_id, teacher_id, class_time, 

function assign_teacher() {
	global $conn;
	if(isset($_POST['assign_class_btn'])) {

		if(!isset($_POST['week_days'])) {
			header("Location: assign_teacher.php?action=add-new");
		}
		$global_name_id = $_POST['global_name_id'];
		$subject_name_id = $_POST['subject_name_id'];
		$teacher_email 	= $_POST['teacher_email'];
		$class_time 	= clean_data($_POST['class_time']);
		$week_days_array = $_POST['week_days'];
		$week_days = json_encode($week_days_array);
		$is_class_teacher = "N";

		if(isset($_POST['is_class_teacher'])) {
			$is_class_teacher = "Y";
		}

		if(!empty($class_time)) {
			$query = "INSERT INTO class_teacher (global_name_id, subject_name_id, teacher_email, class_time, class_days, is_class_teacher) VALUES ('$global_name_id', '$subject_name_id', '$teacher_email', '$class_time', '$week_days', '$is_class_teacher')";
			$result = mysqli_query($conn, $query);
			if(!$result) {
				die(mysqli_error($conn));
			} else {
				header("Location: assign_teacher.php?message=success");
			}
		}
	}
}

function remove_assigned_teacher() {
	global $conn;
	if(isset($_GET['delete_class_teacher'])) {
		$id = $_GET['delete_class_teacher'];
		$query = "DELETE FROM class_teacher WHERE id=$id";
		$result = mysqli_query($conn, $query);
		if($result) {
			header("Location: assign_teacher.php");
		}

	}
}



/****************************************
# teacher dashboard
****************************************/

function get_class_by_global_name_id($id) {
	global $conn;
	$query = "SELECT class_id FROM sections WHERE id=$id";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	return $row['class_id'];
}

function get_grade_by_marks($marks){
	$grade = 0;
	if($marks == 0) {
		$grade = 0;
	} else {
		switch ($marks) {
			case ($marks >= 80 && $marks <= 100):
				$grade = 5.0;
				break;

			case ($marks >= 70 && $marks <80):
				$grade = 4.0;
				break;

			case ($marks >= 60 && $marks <70):
				$grade = 3.0;
				break;

			case ($marks >= 50 && $marks <60):
				$grade = 2.0;
				break;

			case ($marks >= 33 && $marks <50):
				$grade = 1.0;
				break;
			
			default:
				$grade = 0;
				break;
		}
	}
	return $grade;
}

function get_student_roll_by_id($student_id) {
	global $conn;
	$query = "SELECT student_roll FROM students WHERE student_email='$student_id' LIMIT 1";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	return intval($row['student_roll']);
}

function final_grading_point($totalGrades, $totalSub) {
	$final_grade = 0;
	if($totalSub == 0) {
		$final_grade = 0;
	} else {
		$final_grade = $totalGrades / $totalSub;
		$final_grade = number_format($final_grade, 2, '.', '');
	}
	return $final_grade;
}

/*******************************
@ Page contents
*******************************/
//about page
function about_content_update() {
	global $conn;
	if(isset($_POST['save_about_content'])) {
		$content = $_POST['about_content'];
		$query = "SELECT * FROM page_contents WHERE page_name='about_page'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) <= 0) {
			$insert_query = "INSERT INTO page_contents(page_name, page_text) VALUES('about_page', '$content')";
		} else {
			$insert_query = "UPDATE page_contents SET page_text='$content' WHERE page_name='about_page'";
		}
		$final_result = mysqli_query($conn, $insert_query);
	}
}

//teacher page
function teacher_content_update() {
	global $conn;
	if(isset($_POST['save_teacher_content'])) {
		$content = $_POST['teacher_content'];
		$query = "SELECT * FROM page_contents WHERE page_name='teacher_page'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) <= 0) {
			$insert_query = "INSERT INTO page_contents(page_name, page_text) VALUES('teacher_page', '$content')";
		} else {
			$insert_query = "UPDATE page_contents SET page_text='$content' WHERE page_name='teacher_page'";
		}
		$final_result = mysqli_query($conn, $insert_query);
	}
}

function school_address_update() {
	global $conn;
	if(isset($_POST['save_school_address'])) {
		$school_address = $_POST['school_address'];
		$query = "SELECT * FROM page_options WHERE school_meta_key='school_address'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) <= 0) {
			$insert_query = "INSERT INTO page_options(school_meta_key, school_meta_value) VALUES('school_address', '$school_address')";
		} else {
			$insert_query = "UPDATE page_options SET school_meta_value='$school_address' WHERE school_meta_key='school_address'";
		}
		$final_result = mysqli_query($conn, $insert_query);
	}
}

function school_name_update() {
	global $conn;
	if(isset($_POST['save_school_name'])) {
		$school_name = $_POST['school_name'];
		$query = "SELECT * FROM page_options WHERE school_meta_key='school_name'";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) <= 0) {
			$insert_query = "INSERT INTO page_options(school_meta_key, school_meta_value) VALUES('school_name', '$school_name')";
		} else {
			$insert_query = "UPDATE page_options SET school_meta_value='$school_name' WHERE school_meta_key='school_name'";
		}
		$final_result = mysqli_query($conn, $insert_query);
		if(!$final_result) die(mysqli_error($conn));
	}
}

//admission page
function admission_content_update() {
	global $conn;
	if(isset($_POST['save_admission_content'])) {
		$content = $_POST['admission_content'];
		$query = "SELECT * FROM page_contents WHERE page_name='admission_page'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) <= 0) {
			$insert_query = "INSERT INTO page_contents(page_name, page_text) VALUES('admission_page', '$content')";
		} else {
			$insert_query = "UPDATE page_contents SET page_text='$content' WHERE page_name='admission_page'";
		}
		$final_result = mysqli_query($conn, $insert_query);
	}
}

// gallery content
function gallery_content_update() {
	global $conn;
	if(isset($_POST['save_gallery_content'])) {
		$content 		= $_FILES['gallery_content']['name'];
		$content_tmp 	= $_FILES['gallery_content']['tmp_name'];

		$new_path = '../assets/images/gallery-image/'.$content;

		move_uploaded_file($content_tmp, $new_path);

		if(!empty($content)) {
			$insert_query = "INSERT INTO page_contents(page_name, page_image) VALUES('gallery_page', '$content')";
			$final_result = mysqli_query($conn, $insert_query);
		}
	}
}
function delete_gallery_image() {
	global $conn;
	if(isset($_GET['delete-image'])) {
		$id = $_GET['delete-image'];
		$query = "DELETE FROM page_contents WHERE id=$id";
		$res = mysqli_query($conn, $query);
		if($res) {
			header("Location: content_gallery.php");
		}
	}
}

function logo_content_update() {
	global $conn;
	if(isset($_POST['save_logo_content'])) {

		$content 		= $_FILES['logo_content']['name'];
		$content_tmp 	= $_FILES['logo_content']['tmp_name'];

		$new_path = '../assets/images/'.$content;

		move_uploaded_file($content_tmp, $new_path);

		$query = "SELECT * FROM page_contents WHERE page_name='site_logo'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) <= 0) {
			$insert_query = "INSERT INTO page_contents(page_name, page_image) VALUES('site_logo', '$content')";
		} else {
			$insert_query = "UPDATE page_contents SET page_image='$content' WHERE page_name='site_logo'";
		}
		$final_result = mysqli_query($conn, $insert_query);
	}
}

function get_school_name() {
	global $conn;
	$query = "SELECT * FROM page_options WHERE school_meta_key='school_name'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$school_name = $row['school_meta_value'];
	} else {
		$school_name = 'DEMO SCHOOL';
	}
	return $school_name;
}

function get_school_address() {
	global $conn;
	$query = "SELECT * FROM page_options WHERE school_meta_key='school_address'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$school_addr = $row['school_meta_value'];
	} else {
		$school_addr = 'Dhaka, Bangladesh';
	}
	return $school_addr;
}

/****************************************
@ Dashboard Features
****************************************/
$name = "Name";

function total_class() {
	global $conn;
	$query = "SELECT id FROM class";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

function total_section() {
	global $conn;
	$query = "SELECT id FROM sections";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

function total_subject() {
	global $conn;
	$query = "SELECT id FROM subjects";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

function total_teacher() {
	global $conn;
	$query = "SELECT id FROM teachers";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

function total_students() {
	global $conn;
	$query = "SELECT id FROM students";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

function total_students_by_class($class) {
	global $conn;
	$query = "SELECT id FROM students WHERE student_class=$class";
	$result = mysqli_query($conn, $query);
	return mysqli_num_rows($result);
}

function total_attendance_today_by_class($class) {
	global $conn;
	$thetoday = date("Y-m-d");
	$query = "SELECT attendance.global_name_id, sections.id FROM attendance INNER JOIN sections ON attendance.global_name_id=sections.id WHERE sections.class_id=$class AND attendance.dates='$thetoday' AND attendance.attendance='Y'";
	$result = mysqli_query($conn, $query);
	if(!$result) {
		die(mysqli_error($conn));
	}
	return mysqli_num_rows($result);
}


//final result calculation

function result_calculation_by_class_exam_type($global_name_id, $exam_type, $subject_id) {
	global $conn;
	$query = "SELECT * FROM results WHERE global_name_id=$global_name_id AND exam_type='$exam_type' AND subject_id=$subject_id";
	$result = mysqli_query($conn, $query);

	if(!$result) {
		die(mysqli_error($conn));
	}
	while($row = mysqli_fetch_assoc($result)) {
		echo $row['student_id'] . "<br>";
		echo $row['marks'] . "<hr>";
	}
}

/// this function is to use in admin dashboard to save the results of a specific class by exam_type
// this is main function to save all the results
//Only take care of this function if you have a good idea of array in php
function get_all_students_result_by_class($class, $exam_type) {
	global $conn;
	$year = date("Y");
	$classResultsArray = [];

	$query = "SELECT DISTINCT student_id, student_roll FROM results WHERE student_class=$class AND exam_year=$year ORDER BY student_roll ASC";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		$student_id = $row['student_id'];

		$classResultsArray[] = calculate_result_by_student_by_exam_type($student_id, $year, $exam_type);

	}
}

//called by a looping function
function calculate_result_by_student_by_exam_type($student_id, $year, $exam_type) {
	global $conn;
	$query = "SELECT * FROM results WHERE student_id='$student_id' AND exam_type='$exam_type' AND exam_year=$year";
	$result = mysqli_query($conn, $query);

	if(!$result) {
		die(mysqli_error($conn));
	}
	$subjects = 0;
	$totalGrades = 0;
	$failed = false;
	$totalMarks = 0;

	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$grade = $row['grade'];
			$marks = $row['marks'];
			$student_roll = $row['student_roll'];
			$student_class = $row['student_class'];

			$totalMarks = $totalMarks + $marks;

			$totalGrades = $totalGrades + $grade;
			$subjects++;

			if($grade == 0) {
				$failed = true;
			}
		}
		if($subjects != 0) {
			// $final_gpa = round($totalGrades / $subjects);
			$gpa = $totalGrades / $subjects;
			$final_gpa = number_format($gpa, 2, '.', '');
		} else {
			$final_gpa = 0;
		}

		save_results_to_database($student_id, $student_roll, $failed, $final_gpa, $totalMarks, $student_class);
	}

}

//called by a lookping function
function save_results_to_database($student_id, $student_roll, $failed, $final_gpa, $totalMarks, $student_class) {
	global $conn;

	if($failed) {
		$result_status = 'failed';
	} else {
		$result_status = 'passed';
	}
	$delete_first = "DELETE FROM grading_result WHERE student_id='$student_id'";
	$delete_result = mysqli_query($conn, $delete_first);

	$query = "INSERT INTO grading_result (student_id, total_marks, final_gpa, result_status, current_roll, student_class) VALUES('$student_id', $totalMarks, $final_gpa, '$result_status', $student_roll, $student_class)";
	$result = mysqli_query($conn, $query);
	if(!$result) die(mysqli_error($conn));
}

//This function will calculate the roll number and section of newly created results.
function update_roll_for_new_exam($class) {
	global $conn;
	$sectionA = [];
	$sectionB = [];
	$total_students = [];

	$query = "SELECT * FROM grading_result WHERE student_class=$class AND result_status='passed'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)) {
		$student_id = $row['student_id'];
		$marks = $row['total_marks'];
		$total_students[$student_id] = $marks;
	}
	arsort($total_students);

	$i = 1;

	foreach ($total_students as $key => $value) {
		if($i%2 == 1) {
			$sectionA[$key] = $value;
		} else {
			$sectionB[$key] = $value;
		}
		$i++;
	}
	$j=1;
	foreach ($sectionA as $key => $value) {
		$update_a_query = "UPDATE grading_result SET position=$j, section='A' WHERE student_id='$key'";
		$update_a_result = mysqli_query($conn, $update_a_query);
		$j++;
	}

	$j=1;
	foreach ($sectionB as $key => $value) {
		$update_b_query = "UPDATE grading_result SET position=$j, section='B' WHERE student_id='$key'";
		$update_b_result = mysqli_query($conn, $update_b_query);
		$j++;
	}
}

///move students to the next class
///This will move the students, no back method can be applied.
function move_students_to_the_next_class($class, $exam_type) {
	global $conn;
	if($exam_type == 'final') {
		$query = "SELECT * FROM grading_result WHERE student_class=$class AND result_status='passed'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_assoc($result)) {
			$student_id = $row['student_id'];
			$section = $row['section'];
			$position = $row['position'];

			if($class==10) {
				$new_class = 10;
			} elseif($class==8) {
				$new_class = 8;
			} else {
				$new_class = $class + 1;
			}
			if($class==8 || $class==10) {
				$update_query = "UPDATE students SET student_class=$new_class, student_section='$section', student_roll=$position, student_status='completed' WHERE student_email='$student_id'";
			} else {
				$update_query = "UPDATE students SET student_class=$new_class, student_section='$section', student_roll=$position WHERE student_email='$student_id'";
			}

			$checker = $update_result = mysqli_query($conn, $update_query);
			if($checker) {
				// $delete_all = "DELETE * FROM grading_result";
				// mysqli_query($conn, $delete_all);
				header("Location: calculate_results.php?message=success");
			}
		}
	}
}

//function to make failed students failed
function make_failed_students_inactive($class, $exam_type) {
	global $conn;
	$query = "SELECT * FROM grading_result WHERE student_class=$class AND result_status='failed'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)) {
		$student_id = $row['student_id'];
		$position = $row['position'];

		$update_query = "UPDATE students SET student_roll=$position, student_status='failed' WHERE student_email='$student_id'";
		$result2 = mysqli_query($conn, $update_query);
	}

}

function check_result_submission_by_teachers() {
	global $conn;
	$all_subjects = "SELECT global_name_id, subject_name_id, teacher_email FROM class_teacher";
	$all_sub_res = mysqli_query($conn, $all_subjects);

	$all_string = [];

	while ($row=mysqli_fetch_assoc($all_sub_res)) {
		$all_string[] = $row['global_name_id'] . "," . $row['subject_name_id'] . "," . $row['teacher_email'];
	}

	$all_results = "SELECT global_name_id, subject_id, teacher_email FROM results WHERE exam_type='final'";
	$all_results_res = mysqli_query($conn, $all_results);

	$res_string = [];

	while ($row=mysqli_fetch_assoc($all_results_res)) {
		$res_string[] = $row['global_name_id'] . "," . $row['subject_id'] . "," . $row['teacher_email'];
	}

	$not_updated_list = array_diff($all_string, $res_string);
	if(!empty($not_updated_list)) {

		echo '<h3 class="text-center">These teachers did not input their results yet.</h3><hr>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Class Name</th>
					<th>Subject Name</th>
					<th>Teacher Name</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($not_updated_list as $key => $value) {
			$not_updated_teachers_array = explode(',', $value);

			echo "<tr>";
			echo "<td>" . get_global_name($not_updated_teachers_array[0]) . "</td>";
			echo "<td>" . get_subject_name_by_id($not_updated_teachers_array[1]) . "</td>";
			echo "<td>" . get_name_by_email($not_updated_teachers_array[2]) . "</td>";
			echo "</tr>";
		}
		echo '</tbody></table>';
	} else {
		return "ready";
	}
}

//check if grading result table is empty
function empty_grading_result() {
	global $conn;
	$query = "SELECT * FROM students WHERE student_status='active' AND student_class=6";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		$empty = false;
	} else {
		return true;
	}
}

//get global name by global name id

function get_global_name($id) {
	global $conn;
	$query = "SELECT global_name FROM sections WHERE id=$id";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	return $row['global_name'];
}

//function to get letter grade from point grade
//pass this function where you want Letter grade instead of Point Grade.
function letter_grade_from_grade($grade) {
	$grade = floatval($grade);
	switch ($grade) {
		case ($grade >=5):
			$letter_grade = "A+";
			break;

		case ($grade >=4 && $grade <5):
			$letter_grade = "A";
			break;

		case ($grade >=3 && $grade <4):
			$letter_grade = "B";
			break;

		case ($grade >=2 && $grade <3):
			$letter_grade = "C";
			break;

		case ($grade >=1 && $grade <2):
			$letter_grade = "D";
			break;
		
		default:
			$letter_grade = "F";
			break;
	}
	return $letter_grade;
}