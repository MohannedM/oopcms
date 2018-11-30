<?php include "includes/admin_header.php"; ?>
<?php
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_profile_data_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_profile_data_query)){
       $username = $row['username'];
       $user_password = $row['user_password'];
       $user_firstname = $row['user_firstname'];
       $user_lastname = $row['user_lastname'];
       $user_email = $row['user_email'];
       $user_role = $row['user_role'];
    }
}

?>
    <?php
if(isset($_POST['update_profile'])){
     $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    
//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];
        
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    
    if(!empty($user_password)){
    
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}'";
    $query .= "WHERE username = '{$username}'";
    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
}
}






?>

    <div id="wrapper">

        <!-- Navigation -->
     <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Author</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                                </div>   
                            <div class="form-group">
                                <label for="lasttname">Lastname</label>
                                <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                                </div>


                            <div class="form-group">
                               <label for="user_role">User Role</label>
                               <select name="user_role" id="">
                                    <?php 
                                   echo "<option value='$user_role'>$user_role</option>";
                                   if($user_role == 'admin'){
                                       echo "<option value='subscriber'>subscriber</option>";
                                   } else {
                                       echo "<option value='admin'>admin</option>";
                                   }

                                   ?>

                               </select>


                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" autocomplete="off" type="password" name="user_password">
                            </div>
                            <div class="form-group"><input type="submit" name="update_profile" value="Update Profile" class="btn btn-primary"></div>
                        </form>

                        
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
