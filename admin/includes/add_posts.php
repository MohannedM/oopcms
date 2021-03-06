<?php
if(isset($_POST['add_post'])){
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "INSERT INTO posts (post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date) ";
    $query .= "VALUES('{$post_title}', {$post_category_id}, '{$post_author}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now()) ";
    $add_posts_query = mysqli_query($connection, $query);
    confirmQuery($add_posts_query);
    $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='posts.php?source=edit_post'>Edit Other Posts</a></p>";
    
}



?>
   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
        </div>
    <div class="form-group">
       <label for="post_category_id">Post Category</label>
       <select name="post_category_id" id="">
           <?php
           $query = "SELECT * FROM categories";
           $select_categories_query = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select_categories_query)){
               $cat_id = $row['cat_id'];
               $cat_title = $row['cat_title'];
               echo "<option value='$cat_id'>$cat_title</option>";
           }
           
           
           
           
           ?>
           
           
       </select>
       
        
    </div>
    <div class="form-group">
       <label for="post_author">Post Author</label>
       <select name="post_author" id="">
           <?php
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
        <select name="post_status" id="">
            <option value="Draft">Post Status</option>
            <option value="Published">Published</option>
            <option value="Draft">Draft</option>
        </select>
        
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div> 
  <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="30"></textarea>
  </div>
    <div class="form-group"><input type="submit" name="add_post" value="Add Post" class="btn btn-primary"></div>
</form>