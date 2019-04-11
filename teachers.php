<?php require_once "includes/header.php"; ?>

	<?php require_once "includes/banner.php" ?>
	
	<div class="about-section section-padding teacher-section">
        <?php if(!isset($_GET['t_id'])) { ?>
		<div class="container">
			<div class="row">
                <?php
                    $query = "SELECT * FROM teachers LEFT JOIN user ON teachers.teacher_email=user.username";
                    $result = mysqli_query($conn, $query);
                    if(!$result) {
                        die(mysqli_error($conn));
                    }
                ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4">
					<div class="single-about text-center">
                        <img src="assets/images/teacher-images/<?php echo $row['teacher_image']; ?>" alt="">
                        <div class="theme-margin"></div>
                        <h4 class="teacher-name"><?php echo $row['user_firstname']; ?> <?php echo $row['user_lastname']; ?></h4>
                        <p><?php echo $row['teacher_designation']; ?></p>
                        <a href="teachers.php?t_id=<?php echo $row['id']; ?>" class="btn btn-success btn-block">See Details</a>
					</div>
				</div>
                <?php } ?>
			</div>
		</div>
        <?php } else { ?>

        <!-- single teacehr view -->
        <div class="container">
            <div class="row">
                <?php
                    $id = $_GET['t_id'];
                    $query = "SELECT * FROM teachers INNER JOIN user ON user.username=teachers.teacher_email AND user.id=$id";
                    $result = mysqli_query($conn, $query);
                    if(!$result) {
                        die(mysqli_error($conn));
                    }
                    $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-md-4 col-md-offset-4">
                    <img src="assets/images/teacher-images/<?php echo $row['teacher_image']; ?>" alt="">
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>First Name</th>
                                <td><?php echo $row['user_firstname'] ?></td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td><?php echo $row['user_lastname'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $row['username'] ?></td>
                            </tr>
                            <tr>
                                <th>Designation</th>
                                <td><?php echo $row['teacher_designation'] ?></td>
                            </tr>
                            <tr>
                                <th>Qualification</th>
                                <td><?php echo $row['teacher_qualification'] ?></td>
                            </tr>
                            <tr>
                                <th>Adress</th>
                                <td><?php echo $row['teacher_address'] ?></td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td><?php echo $row['teacher_contact'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
	</div>

<?php require_once "includes/footer.php"; ?>