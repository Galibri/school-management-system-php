<?php require_once "includes/header.php"; ?>
	<h1>Admin</h1>
		<div class="row">
			<?php if(isset($_GET['message']) && $_GET['message'] == 'success') : ?>
				<div class="col-md-12">
					<h3 class="bg-success text-center">Updated!</h3>
				</div>
			<?php endif; ?>
			<div class="col-md-12">
				<?php
					$query = "SELECT * FROM user WHERE user_role='administrator' LIMIT 1";
					$result = mysqli_query($conn, $query);
					if(!$result) {
						die(mysqli_error());
					}
					while($row = mysqli_fetch_assoc($result)) {
						$username = $row['username'];
						$user_password = $row['user_password'];
						$user_firstname = $row['user_firstname'];
						$user_lastname = $row['user_lastname'];
					?>
					<table class="table table-bordered">
						<tbody>
							<form action="" method="POST">
							<tr>
								<td>Username: </td>
								<td><input type="email" name="username" class="form-control" value="<?php echo $username; ?>" required></td>
							</tr>
							<tr>
								<td>Password: </td>
								<td><input type="password" name="user_password" class="form-control" value=""></td>
							</tr>
							<tr>
								<td>First Name: </td>
								<td><input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname; ?>" required></td>
							</tr>
							<tr>
								<td>Last Name: </td>
								<td><input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname; ?>" required></td>
							</tr>
							<tr>
								<td colspan="2" class="text-center"><input type="submit" name="update_admin_profile" value="Update" class="btn btn-warning"></td>
							</tr>
							</form>
						</tbody>
					</table>
				<?php } ?>
			</div>
		</div>
<?php require_once "includes/footer.php"; ?>

<?php
if(isset($_POST['update_admin_profile'])) {
	$username = $_POST['username'];
	$user_password = $_POST['user_password'];
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];

	if(!empty($username)) {
		if(!empty($user_password)) {
			$update_q = "UPDATE user SET username='$username', user_password='$user_password', user_firstname='$user_firstname', user_lastname='$user_lastname' WHERE user_role='administrator'";
		} else {
			$update_q = "UPDATE user SET username='$username', user_firstname='$user_firstname', user_lastname='$user_lastname' WHERE user_role='administrator'";
		}
		$result_update = mysqli_query($conn, $update_q);
		if($result_update) {
			header("Location: admin_profile.php?message=success");
		}
	}
}
?>