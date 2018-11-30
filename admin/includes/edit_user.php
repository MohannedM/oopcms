<?php
if(isset($_GET['u_id'])){
    
    
    $the_user_id = $_GET['u_id'];
    
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users_query)){
       $db_username = $row['username'];
       $db_user_password = $row['user_password'];
       $db_user_firstname = $row['user_firstname'];
       $db_user_lastname = $row['user_lastname'];
       $db_user_email = $row['user_email'];
       $db_user_image = $row['user_image'];
       $db_user_role = $row['user_role'];
        
    

}
if(isset($_POST['update_user'])){

    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    
//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];
        
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    
    
    
    
    if(!empty($user_password)){
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        
    
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}'";
    $query .= "WHERE user_id = $the_user_id";
    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
    echo "<p class='bg-success'>User Updated <a href='users.php'>Edit More Users</a></p>";
}
}

} else {
    header("Location: users.php");
}


?>
   

<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" value="<?php echo $db_user_firstname; ?>" class="form-control" name="user_firstname">
        </div>   
    <div class="form-group">
        <label for="lasttname">Lastname</label>
        <input type="text" value="<?php echo $db_user_lastname; ?>" class="form-control" name="user_lastname">
        </div>
        
        
    <div class="form-group">
       <label for="user_role">User Role</label>
       <select name="user_role" id="">
            <?php 
           echo "<option value='$db_user_role'>$db_user_role</option>";
           if($db_user_role == 'admin'){
               echo "<option value='subscriber'>subscriber</option>";
           } else {
               echo "<option value='admin'>admin</option>";
           }
           
           ?>

       </select>
       
        
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $db_username; ?>" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="<?php echo $db_user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" autocomplete="off" type="password" name="user_password">
    </div>
    <div class="form-group"><input type="submit" name="update_user" value="Update User" class="btn btn-primary"></div>
</form>