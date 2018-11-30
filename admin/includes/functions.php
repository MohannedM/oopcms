<?php
function users_online(){
    global $connection;
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;
        
        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $select_user_onilne = mysqli_query($connection, $query);
        $count = mysqli_num_rows($select_user_onilne);
        
        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online (session, time) VALUES ('$session', $time)");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = $time WHERE session = '$session'");
        }
        
        $query = "SELECT * FROM users_online WHERE time > $time_out";
        $users_online_query = mysqli_query($connection, $query);
        $_SESSION['users_online'] = $users_online_count = mysqli_num_rows($users_online_query);
        
        
}
function addCategory(){
    global $connection;
        if(isset($_POST['add_category'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
        echo "This field can not be empty.";
        } else{
        $query = "INSERT INTO categories (cat_title) ";
        $query .= "VALUE ('{$cat_title}') ";
        $add_category_query = mysqli_query($connection, $query);
        if(!$add_category_query){
        die("QUERY FAILED" . mysqli_error($connection));
        }
        }
        }
}
function selectAllCategories(){
    global $connection;
        // Select All Categories Query
        $query = "SELECT * FROM categories";
        $select_categories_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_categories_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
        }

                            
}
function deleteCategory(){
    global $connection;
        if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
        if(!$delete_query){
        die("QUERY FAILED" . mysqli_error($connection));
        }
        }
    
}
function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}
function recordCount($table){
    global $connection;
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $record_count = mysqli_num_rows($result);
    
}
function checkStatus($table, $column, $status){
    global $connection;
    $query = "SELECT * FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $record_count = mysqli_num_rows($result); 
}
function is_admin($username){
    global $connection;
    
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    
    $result = mysqli_query($connection, $query);    
    confirmQuery($result);
    $row = mysqli_fetch_assoc($result);
    
    if($row['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }   
}
function username_exists($username){
    
    global $connection;
    
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    
    if(mysqli_num_rows($result) > 0 ){
        return true;
    } else {
        return false;
    }
    
}
function email_exists($email){
    
    global $connection;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    
    if(mysqli_num_rows($result) > 0 ){
        return true;
    } else {
        return false;
    }
    
}
function register_user($username, $email, $password){
    
    global $connection;
    
        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
        
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
        
        $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
        
        $registraion_query = mysqli_query($connection, $query);
        confirmQuery($registraion_query);
     
}
function login_user($username, $password){
    
    global $connection;
    
    $username = trim($username);
    $password = trim($password);
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_username_query = mysqli_query($connection, $query);
    
    if(!$select_username_query){
        die('Query Failed' . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_assoc($select_username_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_password = $row['user_password'];
    }
if(password_verify($password, $db_user_password)){
 
    $_SESSION['username'] = $db_username; 
    $_SESSION['firstname'] = $db_user_firstname; 
    $_SESSION['lastname'] = $db_user_lastname; 
    $_SESSION['user_role'] = $db_user_role; 
    
    header("Location: /cms2/admin");
} else {
     header("Location: /cms2/index.php");
}

    
}
    

///$password = crypt($password, $db_user_password); // old way


















