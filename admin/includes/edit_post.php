<?php
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_all_posts_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_posts_query)){
   $post_id = $row['post_id'];
   $post_author = $row['post_author'];
   $post_title = $row['post_title'];
   $post_category_id = $row['post_category_id'];
   $post_status = $row['post_status'];
   $post_image = $row['post_image'];
   $post_tags = $row['post_tags'];
   $post_comment_count = $row['post_comment_count'];
   $post_date = $row['post_date'];
   $post_content = $row['post_content'];
    
}

if(isset($_POST['update_post'])){
   $post_author = $_POST['post_author'];
   $post_title = $_POST['post_title'];
   $post_category_id = $_POST['post_category'];
   $post_status = $_POST['post_status'];
    
   $post_image = $_FILES['image']['name'];
   $post_image_temp = $_FILES['image']['tmp_name'];
    
   $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)){
        
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_image_query)){
            $post_image = $row['post_image'];
        }
    }
    
    $query = "UPDATE posts SET ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_date = now() ";
    $query .= "WHERE post_id = $the_post_id ";
    $update_query = mysqli_query($connection, $query);
    confirmQuery($update_query);
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

}                           







?>
   

   
   
   

   

   
         
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>" >
        </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_all_categories = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_all_categories)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                if($post_category_id == $cat_id){
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                } else {
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            
            
            ?>
            
        </select>
    </div>
    <div class="form-group">
       <label for="post_author">Post Author</label>
       <select name="post_author" id="">
           <?php
           echo "<option value='$post_author'>$post_author</option>";
           $query = "SELECT * FROM users";
           $select_users_query = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_users_query)){
               $user_id = $row['user_id'];
               $username = $row['username'];
               echo "<option value='$username'>$username</option>";
           }
           
           
           
           
           ?>
           
           
       </select>
       
        
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            if($post_status == 'Published'){
                echo "<option value='Draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Published</option>";
            }
            
            
            
            
            ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
        <img src="../images/<?php echo $post_image; ?>" width="100" alt="">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div> 
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="100" rows="10"><?php echo str_replace('\r\n', <br>, $post_content;) ?></textarea>
    </div>
    <div class="form-group"><input type="submit" name="update_post" value="Update Post" class="btn btn-primary"></div>
</form>