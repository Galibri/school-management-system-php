<?php require_once "includes/header.php"; ?>

    <?php require_once "includes/banner.php" ?>
    <?php
        if(is_user_logged_in()) {
            header("Location: index.php");
        }
    ?>
  
	<div class="about-section section-padding admission-section">
		<div class="container">
            <div class="row">
               <div class="col-md-4 col-md-offset-4">
                <?php $login_error = user_login(); ?>
                   <h4><strong>Login here</strong></h4>
                   <?php
                    if(!empty($login_error)) {
                      echo "<h3 class='bg-danger'>{$login_error}</h3>";
                    }
                   ?>
                   <form action="" method="post">
                       <div class="form-group">
                           <label for="">Username</label>
                            <input type="email" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                                <label for="">Password</label>
                                 <input type="password" class="form-control" name="user_password">
                             </div>
                       <div class="form-group">
                            <label for="">User Role</label>
                           <select name="user_role" id="" class="form-control">
                               <option value="">Select Your Role</option>
                               <option value="administrator">Admin</option>
                               <option value="teacher">Teacher</option>
                               <option value="student">Student</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <input type="submit" class="btn btn-success" name="user_login" value="Login">
                       </div>
                   </form>
               </div>
            </div>
        </div>
    </div>

<?php require_once "includes/footer.php"; ?>