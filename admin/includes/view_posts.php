<?php ob_start(); ?>
<?php
if(isset($_POST['checkBoxArray'])){
    $checkBoxArray = $_POST['checkBoxArray'];
    $bulkoptions = $_POST['BulkOptions'];
    foreach($checkBoxArray as $postValueId){
        
        switch($bulkoptions){
            case 'Published':
                $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = {$postValueId}";
                $update_selected_posts = mysqli_query($connection, $query);
                break;
            case 'Draft':
                $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = {$postValueId}";
                $update_selected_posts = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $delete_selected_posts = mysqli_query($connection, $query);
                break;         
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                $select_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_posts_query)){
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
                $query = "INSERT INTO posts (post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content) ";
                $query .= "VALUES ('{$post_author}', '{$post_title}', {$post_category_id}, '{$post_status}', '{$post_image}','{$post_tags}', '{$post_content}')";
                $clone_query = mysqli_query($connection, $query);
                if(!$clone_query){
                    die('Query Failed' . mysqli_error($connection) . mysqli_errno($connection));
                }
                break;
        }
    }
}



?>
                <form action="" method="post">
                   
                    <div class="col-xs-4" id="bulkOptionsContainer" >
                        <select class="form-control" name="BulkOptions" id="">
                            <option value="">Select Option</option>
                            <option value="Published">Publish</option>
                            <option value="Draft">Draft</option>
                            <option value="delete">Delete</option>
                            <option value="clone">Clone</option>
                        </select>
                        <div class="col-ms-4">
                            <input type="submit" class="btn btn-success" name="submit" value="Apply">
                            <a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>
                        </div>
                        
                        
                    </div>
                
                 <table class="table table-bordered table-hover">
                   <thead>
                       <tr>
                           <th><input type="checkbox" id="selectAllBoxes"></th>
                           <th>Id</th>
                           <th>Author</th>
                           <th>Title</th>
                           <th>Category</th>
                           <th>Status</th>
                           <th>Image</th>
                           <th>Tags</th>
                           <th>Comments Count</th>
                           <th>Date</th>
                           <th>View Post</th>
                           <th>Edit</th>
                           <th>Delete</th>
                           <th>Post Views</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                       
//                       $query = "SELECT * FROM posts ORDER BY post_id DESC";
                       $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, ";
                       $query .= "posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, ";
                       $query .= "posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
                       $query .= "FROM posts ";
                       $query .="LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";
                       $query .= "ORDER BY posts.post_id DESC";
                       $select_all_posts_query = mysqli_query($connection, $query);
                       confirmQuery($select_all_posts_query);
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
                           $post_views_count = $row['post_views_count'];
                           $cat_id = $row['cat_id'];
                           $cat_title = $row['cat_title'];
                           
                           echo "<tr>";
                           ?>
                           <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                           <?php
                           echo "<td>{$post_id}</td>";
                           echo "<td>{$post_author}</td>";
                           echo "<td>{$post_title}</td>";
                
                           
                           echo "<td>{$post_status}</td>";
                           echo "<td><img src='../images/{$post_image}' width='100'></td>";
                           echo "<td>{$post_tags}</td>";
                           
                           $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                           $find_comments_count = mysqli_query($connection, $query);
                           $comment_count = mysqli_num_rows($find_comments_count);
                           
                           echo "<td><a href='post_comments.php?id=$post_id'>{$comment_count}</a></td>";
                           
                           
                           echo "<td>{$post_date}</td>";
                           echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                           echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                           echo "<td><a onClick=\"javascript: return confirm('Delete Post?') \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                           echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
                           echo "</tr>";
                       }
                    
                       
                       ?>
                   </tbody>
               </table> 
               </form>
               
<?php 
if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
//    confrimQuery($delete_query);
}
if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $the_post_id);
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts.php");
//    confrimQuery($delete_query);
}






?>
               
               
               
               
               
               
               
               
               
               
               
               