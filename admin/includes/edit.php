        <form action="" method="post">
        <div class="form-group">
        <label for="cat_title">Edit Category</label>
           <?php 
            if(isset($_GET['edit'])){
                $the_cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories where cat_id = '{$the_cat_id}' ";
                $select_categories_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_categories_query)){
                    $cat_title = $row['cat_title'];
                    ?>
                <input type="text" class="form-control" name="cat_title" value="<?php if(isset($cat_title)) {echo $cat_title;} ?> ">
           <?php         
                }
            } ?>
   
            <?php
           if(isset($_POST['edit'])){
            $the_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = '{$cat_id}' ";
            $edit_category_query = mysqli_query($connection, $query);
            if(!$edit_category_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
            if($the_cat_title == "" || empty($the_cat_title)){
                echo "This field can not be empty.";
            } 
        }

?>

            </div>
            <div class="form-group">
                <input type="submit" name="edit" class="btn btn-primary" value="Update Category">
            </div>
            </form>